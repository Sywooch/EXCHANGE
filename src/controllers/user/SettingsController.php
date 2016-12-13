<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 4:25
 */

namespace app\controllers\user;


use dektrium\user\models\SettingsForm;

class SettingsController extends \dektrium\user\controllers\SettingsController
{

	public function actionAccount()
	{
		/** @var SettingsForm $model */
		$model = \Yii::createObject(SettingsForm::className());
		$event = $this->getFormEvent($model);

		$this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
		if ($model->load(\Yii::$app->request->post()) && $model->save()) {
			$this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
			return $this->redirect(['account/security']);
		}

		return $this->render('account', [
				'model' => $model,
		]);
	}

}