<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 2:45
 */

namespace app\controllers;


use app\models\Currency;
use yii\filters\AccessControl;
use yii\web\Controller;

class AccountController extends Controller
{

	public $layout = 'account';

	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'rules' => [
								['allow' => true, 'actions' => ['index','security','autofill','referer','materials','forms'], 'roles' => ['@']],
						],
				],
		];
	}

	public function actionIndex(){
		$orders = \Yii::$app->user->identity->orders;

		return $this->render('index',[
				'orders'=>$orders
		]);
	}

	public function actionSecurity(){
		return $this->render('security');
	}

	public function actionAutofill(){
		return $this->render('autofill');
	}

	public function actionReferer(){
		return $this->render('referer');
	}

	public function actionMaterials(){
		return $this->render('materials');
	}

	public function actionForms(){
		return $this->render('forms');
	}

}