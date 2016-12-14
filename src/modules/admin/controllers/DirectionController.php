<?php

namespace app\modules\admin\controllers;

use app\models\Currency;
use app\models\ExchangeDirection;
use app\models\Order;
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
class DirectionController extends AdminController
{
	public $dashboardPage = ['/admin'];

	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
				'access' => [
						'class' => AccessControl::className(),
						'only' => ['index'],
						'rules' => [
								[
										'actions' => ['index'],
										'allow' => true,
										'roles' => ['@'],
								],
						],
				],
		]);
	}

	public function actionIndex($currency_from = 3)
	{
		$post = Yii::$app->request->post();
		if ($post) {
			ExchangeDirection::deleteAll(['currency_from' => $currency_from]);
			foreach ($post['directions'] as $direction) {
				$direction['currency_from'] = $currency_from;
				$model = new ExchangeDirection();
				$model->load($direction);
				$model->setAttributes($direction);
				$model->save();
			}
		}

		$directions = ExchangeDirection::find()->where(['currency_from' => $currency_from])->all();
		$currency = Currency::find()->all();

		$current = Currency::findOne(['id' => $currency_from]);
		$orders = Order::findAll(['status' => 1]);

		return $this->render('index', [
				'directions' => $directions,
				'currency' => $currency,
				'cur' => $current,
				'orders' => $orders,
		]);
	}

	public function actions()
	{
		return [
				'error' => [
						'class' => 'nullref\admin\actions\ErrorAction',
				],
		];
	}

}
