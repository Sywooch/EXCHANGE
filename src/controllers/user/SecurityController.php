<?php
namespace app\controllers\user;

use Yii;
use dektrium\user\models\LoginForm;

/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 0:00
 */
class SecurityController extends \dektrium\user\controllers\SecurityController
{

	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			$this->goHome();
		}

		/** @var LoginForm $model */
		$model = \Yii::createObject(LoginForm::className());
		$event = $this->getFormEvent($model);

		//$this->performAjaxValidation($model);
		$this->trigger(self::EVENT_BEFORE_LOGIN, $event);

		if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
			$this->trigger(self::EVENT_AFTER_LOGIN, $event);

			$cookies = \Yii::$app->response->cookies;
			$cookies->remove('referer');

			return $this->refresh();
		}

		return $this->render('login', [
				'model'  => $model,
				'module' => $this->module,
		]);
	}

	public function actionLogout()
	{
		\Yii::$app->getUser()->logout();

		return $this->goHome();
	}

}