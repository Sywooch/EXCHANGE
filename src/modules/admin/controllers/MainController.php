<?php

namespace app\modules\admin\controllers;

use app\components\MailInformer;
use app\models\Currency;
use app\models\ExchangeDirection;
use app\models\Order;
use app\models\Referal;
use app\models\ReferalOrder;
use nullref\admin\components\AdminController;
use nullref\admin\models\Admin;
use nullref\admin\models\LoginForm;
use nullref\admin\models\PasswordResetForm;
use Yii;
use nullref\admin\components\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 *
 */
class MainController extends AdminController
{
    public $dashboardPage = ['/admin'];

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login', 'index', 'error'],
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }

	public function afterAction($action, $result)
	{
		Yii::$app->getUser()->setReturnUrl(Yii::$app->request->url);
		return parent::afterAction($action, $result);
	}

	public function actionIndex($status = 3)
    {

    	if($status == 'referals'){
				$orders = ReferalOrder::find()->where(['!=','status',4])->orderBy('date DESC')->all();
				$status = ['status'=>'referals'];
				return $this->render('referals', [
						'orders'=>$orders,
						'sts'=>$status['status'],
				]);
			} else {
				$status = $status === false ? ['in','status',[Order::STATUS_IN_WORK,Order::STATUS_PAYED_USER]] : ['status'=>$status];
				$orders = Order::find()->where($status)->orderBy('date DESC')->all();
			}

        return $this->render('index', [
            'orders'=>$orders,
						'sts'=>$status['status'],
        ]);
    }

    public function actionSaveOrders(){
    		Yii::$app->response->format = Response::FORMAT_JSON;
    		$items = Yii::$app->request->post('items');

				foreach($items as $item){
					$order = Order::findOne(['id'=>$item['id']]);
					if($order->status != $item['status']){
						MailInformer::send(MailInformer::TEMPLATE_STATUS, 'Смена статуса заявки '.$order->id.' на сайте '.\Yii::$app->name,
								$order->email, $order);
					}
					$order->status = $item['status'];
					$order->voucher = !empty($item['voucher']) ? $item['voucher'] : '';

					if($item['status'] == Order::STATUS_ACCEPTED){
						if($order->user){
							if($order->user->referer){
								$ref = Referal::findOne(['user_id'=>$order->user->referer->id]);
								if(!$ref){
									$ref = new Referal();
									$ref->user_id = $order->user->referer->id;
								}
								$ref->exchanges = $ref->exchanges+1;
								$ref->save();
							}
						}

					}

					$order->save();


				}

				return $this->goBack();
		}


	public function actionSaveReferalOrders(){
		Yii::$app->response->format = Response::FORMAT_JSON;
		$items = Yii::$app->request->post('items');

		foreach($items as $item){
			$order = ReferalOrder::findOne(['id'=>$item['id']]);
			$order->status = $item['status'];
			$order->save();
		}

		return $this->goBack();
	}





    public function actions()
    {
        return [
            'error' => [
                'class' => 'nullref\admin\actions\ErrorAction',
            ],
        ];
    }

    public function actionLogin()
    {
        $this->layout = 'base';

        $model = new LoginForm();

        if (!Yii::$app->get('admin')->isGuest) {
            return $this->redirect($this->dashboardPage);
        }

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->login();
                return $this->redirect($this->dashboardPage);
            } else {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $model->errors;
                }
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->get('admin')->logout();

        return $this->goHome();
    }

    public function actionReset($id, $token = false)
    {
        /** @var Admin $user */
        $user = Admin::findOne($id);
        if (($token !== false) && (isset($user)) && ($user->passwordResetToken === $token) && ($user->passwordResetExpire >= time())) {
            $model = new PasswordResetForm();
            if ($model->load(Yii::$app->getRequest()->post()) && $model->changePassword($user)) {
                Yii::$app->user->login($user);
                return $this->redirect(['index']);
            }
            return $this->render('password-reset', [
                'model' => $model,
            ]);
        }
        throw new NotFoundHttpException();
    }
}
