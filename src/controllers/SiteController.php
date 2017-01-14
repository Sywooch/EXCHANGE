<?php

namespace app\controllers;

use app\components\MailInformer;
use app\models\Currency;
use app\models\ExchangeDirection;
use app\models\Order;
use app\models\OrderFields;
use app\models\Referal;
use app\models\RegistrationForm;
use app\models\Testimonial;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $currency_all = Currency::find()->with('directions')->all();

        $currency = array_filter($currency_all, function($item){
            return $item->directions;
        });

        $orders = Order::find()->orderBy('date DESC')->limit(15)->all();

        $testimonials = Testimonial::findAll(['enabled'=>1]);

        return $this->render('index', [
            'currency'=>$currency,
            'currency_all'=>$currency_all,
            'orders'=>$orders,
            'testimonials'=>$testimonials,
        ]);
    }

    public function actionProcessOrder(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();
        $direction = ExchangeDirection::findOne([
						'currency_from'=>$data['exchange_from_id'],
						'currency_to'=>$data['exchange_to_id'],
				]);
        $data['exchange_id'] = $direction->id;
        $data['date'] = date('Y-m-d H:i:s');
        $model = new Order();
        $model->setAttributes($data);
        $model->status = Order::STATUS_IN_WORK;
				$model->save();

				if(Yii::$app->user->isGuest){
						$form = new RegistrationForm();
						$form->email = $model->email;
						$form->password = $this->generatePassword();
						$form->register();
				}

				if(!empty($data['orderField'])){
					foreach($data['orderField'] as $id => $value){
						$orderField = new OrderFields();
						$orderField->value = $value;
						$orderField->field_id = $id;
						$orderField->order_id = $model->id;
						$orderField->save();
					}
				}

        //reserve
				$currency = $direction->getTo()->one();
				$currency->reserve = round((float)$currency->reserve - (float)$model->to_value, 2);
				if(!$currency->reserve){
					return false;
				}
				$currency->save();

				MailInformer::send(MailInformer::TEMPLATE_ORDER, 'Вы создали заявку на обмен на сайте '.\Yii::$app->name,
						$model->email, $model);

				$cookies = Yii::$app->request->cookies;
				$referer = false;
				if (isset($cookies['referer'])) {
					$referer = $cookies['referer']->value;
				}

				if(!Yii::$app->user->isGuest){
					$sum = Yii::$app->user->identity->getCountOrders()['sumUsd'];
					$bonus = $model->exchange->course * (Yii::$app->user->identity->getBonus($sum)/100);
					$model->to_value = round((float)$model->to_value+(float)$bonus, 4);
					$model->save();
					$user = Yii::$app->user->identity;

					if(!$user->referer && $referer){
						$referal = new Referal();
						$referal->user_id = $referer;
						$referal->referal_id = $user->id;
						$referal->save();
					}

				} else {
					$bonus = 0;

					if($referer){
						/*$referal = new Referal();
						$referal->user_id = $referer;
						$referal->referal_id = 0;
						$referal->save();*/
					}

				}

        return $model ? [
        		'accepted'=>1,
						'orderId'=>$model->id,
						'info'=>[
							'currency'=>$direction->getFrom()->one()->title,
							'wallet'=>$direction->getFrom()->one()->wallet,
							'sum'=>$model->from_value,
							'valute'=>$direction->getFrom()->one()->type
						],
						'voucher'=>$direction->from->is_voucher ? $direction->from->voucher_title : false,
						'bonus'=>$bonus
				] : $model->getErrors();
    }

    public function generatePassword($length = 8) {
			$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$count = mb_strlen($chars);

			for ($i = 0, $result = ''; $i < $length; $i++) {
				$index = rand(0, $count - 1);
				$result .= mb_substr($chars, $index, 1);
			}

			return $result;
		}

	public function actionChangeOrderStatus(){
    	$post = Yii::$app->request->post();

    	$order = Order::findOne(['id'=>$post['id']]);
    	$order->status = Order::STATUS_PAYED_USER;
    	if(!empty($post['voucher'])){
				$order->voucher = $post['voucher'];
			}
    	$order->save();

			MailInformer::send(MailInformer::TEMPLATE_STATUS, 'Смена статуса заявки '.$order->id.' на сайте '.\Yii::$app->name,
					$order->email, $order);

			Yii::$app->response->format = Response::FORMAT_JSON;

    	return true;
		}

    public function actionAjaxCurrency(){
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($post){
            if($post['cur_to_list']){
                return ExchangeDirection::find()
                    ->with('to')
                    ->where(['currency_from'=>$post['cur_to_list']])
                    ->all();
            }

            return $post;
        }

        return false;
    }

    public function actionTestimonial(){
        $post = Yii::$app->request->post();
        $file = UploadedFile::getInstanceByName('avatar');
        Yii::$app->response->format = Response::FORMAT_JSON;

        if($post){
            $model = new Testimonial();
            $model->setAttributes($post);
            $model->save();
						if($file){
							$path = Yii::getAlias('@webroot').'/images/'. $imageName = rand(1000,100000).'.'.$file->extension;
							$file->saveAs($path);
							$model->attachImage($path);
						}
            return 'testimonial';
        }
        return false;
    }

	public function actionLogout()
	{
		\Yii::$app->getUser()->logout();

		return $this->goHome();
	}
}
