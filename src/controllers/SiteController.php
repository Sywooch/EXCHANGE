<?php

namespace app\controllers;

use app\models\Currency;
use app\models\ExchangeDirection;
use app\models\Order;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;


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

        return $this->render('index', [
            'currency'=>$currency,
            'currency_all'=>$currency_all,
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
}
