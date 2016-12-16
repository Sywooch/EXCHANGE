<?php
namespace app\controllers\user;

use app\models\Referal;
use app\models\User;
use Yii;
use app\models\RegistrationForm;
use dektrium\user\controllers\RegistrationController as BaseRegistrationController;
use yii\web\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 0:00
 */
class RegistrationController extends BaseRegistrationController
{

	public function actionRegister()
	{
		if (!$this->module->enableRegistration) {
			throw new NotFoundHttpException();
		}

		$cookies = Yii::$app->request->cookies;

		$referer = false;
		if (isset($cookies['referer'])) {
			$referer = $cookies['referer']->value;
			$cookies->remove('referer');
		}

		/** @var RegistrationForm $model */
		$model = \Yii::createObject(RegistrationForm::className());
		$event = $this->getFormEvent($model);

		$this->trigger(self::EVENT_BEFORE_REGISTER, $event);

		//$this->performAjaxValidation($model);

		if ($model->load(\Yii::$app->request->post()) && $model->register()) {
			$this->trigger(self::EVENT_AFTER_REGISTER, $event);

			if($referer){
				$ref = Referal::findOne(['user_id'=>$referer, 'referal_id'=>User::findOne(['email'=>$model->email])->id]);
				if(!$ref){
					$ref = new Referal();
					$ref->user_id = $referer;
					$ref->referal_id = User::findOne(['email'=>$model->email])->id;
					$ref->save();
				}
			}

			return $this->render('/message', [
					'title'  => \Yii::t('user', 'Your account has been created'),
					'module' => $this->module,
			]);
		}

		return $this->render('register', [
				'model'  => $model,
				'module' => $this->module,
		]);
	}

}