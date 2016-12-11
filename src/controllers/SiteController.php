<?php

namespace app\controllers;

use app\models\Currency;
use app\models\ExchangeDirection;
use app\models\Order;
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

        $orders = Order::find()->all();

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
        $data['exchange_id'] = ExchangeDirection::findOne([
            'currency_from'=>$data['exchange_from_id'],
            'currency_to'=>$data['exchange_to_id'],
        ])->id;
        $data['date'] = date('Y-m-d H:m:s');
        $model = new Order();
        $model->setAttributes($data);

        return $model->save() ? true : $model->getErrors();
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

        if($post && $file){
            $model = new Testimonial();
            $model->setAttributes($post);
            $model->save();
            $path = Yii::getAlias('@webroot').'/images/'. $imageName = rand(1000,100000).'.'.$file->extension;
            $file->saveAs($path);
            $model->attachImage($path);
            return $model->id;
        }
        return false;
    }
}
