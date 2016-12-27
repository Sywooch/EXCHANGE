<?php

namespace app\controllers\user;

use app\models\User;
use dektrium\user\Finder;
use dektrium\user\Mailer;
use dektrium\user\models\RecoveryForm;
use dektrium\user\models\Token;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\debug\models\search\Mail;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RecoveryController manages password recovery process.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RecoveryController extends Controller
{

    public function actionRequest()
    {

        /** @var RecoveryForm $model */
        $model = \Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => RecoveryForm::SCENARIO_REQUEST,
        ]);

        if ($model->load(\Yii::$app->request->post())) {

					$user = User::findOne(['email'=>$model->email]);

					if ($user instanceof User) {
						/** @var Token $token */
						$token = \Yii::createObject([
								'class' => Token::className(),
								'user_id' => $user->id,
								'type' => Token::TYPE_RECOVERY,
						]);

						if (!$token->save(false)) {
							return false;
						}

						if (!$this->sendRecoveryMessage($user, $token)) {
							return false;
						}
					}

            return $this->goHome();
        }
				return $this->goHome();
    }

    protected function sendRecoveryMessage($user, $token) {

    	$html = '
<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    
		Мы получили запрос на сброс пароля учетной записи на '.\Yii::$app->name.'
    Пожалуйста, нажмите на ссылку ниже, чтобы завершить процесс сброса пароля.
</p>
<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    '.Html::a(Html::encode($token->url), $token->url).'
</p>
<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
Если вы не можете нажать на ссылку, пожалуйста, попробуйте вставить текст в адресной строке браузера.
</p>
<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    
Если вы не сделали этого запроса вы можете проигнорировать это сообщение
</p>';

			$mailer = \Yii::$app->mailer;
			$sender = isset(\Yii::$app->params['adminEmail']) ? \Yii::$app->params['adminEmail'] : 'no-reply@example.com';
			return $mailer->compose()
					->setTo($user->email)
					->setFrom($sender)
					->setSubject('Восстановление пароля')
					->setHtmlBody($html)
					->send();

		}

    /**
     * Displays page where user can reset password.
     *
     * @param int    $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */

    public function actionReset($id, $code)
		{

				$token = Token::findOne(['user_id' => $id, 'code' => $code, 'type' => Token::TYPE_RECOVERY]);
        /** @var Token $token */
        //$token = $this->finder->findToken(['user_id' => $id, 'code' => $code, 'type' => Token::TYPE_RECOVERY])->one();
        //$event = $this->getResetPasswordEvent($token);

        //$this->trigger(self::EVENT_BEFORE_TOKEN_VALIDATE, $event);

        if ($token === null || $token->isExpired || $token->user === null) {
          //  $this->trigger(self::EVENT_AFTER_TOKEN_VALIDATE, $event);
            \Yii::$app->session->setFlash(
                'danger',
                \Yii::t('user', 'Recovery link is invalid or expired. Please try requesting a new one.')
            );
            return $this->render('/message', [
                'title'  => \Yii::t('user', 'Invalid or expired link'),
                'module' => $this->module,
            ]);
        }

        /** @var RecoveryForm $model */
        $model = \Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => RecoveryForm::SCENARIO_RESET,
        ]);
        //$event->setForm($model);

        //$this->performAjaxValidation($model);
        //$this->trigger(self::EVENT_BEFORE_RESET, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->resetPassword($token)) {
            //$this->trigger(self::EVENT_AFTER_RESET, $event);
            return $this->goHome();
        }

        return $this->render('//user/recovery/reset', [
            'model' => $model,
        ]);
    }
}
