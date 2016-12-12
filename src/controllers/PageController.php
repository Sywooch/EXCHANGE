<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 5:13
 */

namespace app\controllers;


use app\models\Page;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
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


	public function actionIndex($slug = ''){
		if($slug){
			$model = Page::findOne(['slug'=>$slug]);
			if(!$model){
				throw new NotFoundHttpException('not found');
			}
			return $this->render('index', ['model'=>$model]);
		}
		throw new NotFoundHttpException('not found');
	}

	public function actionHelp(){
			$slug = 'help';
			/*$model = Page::findOne(['slug'=>$slug]);*/
			return $this->render('help', [/*'model'=>$model*/]);
	}

}