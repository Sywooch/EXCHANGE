<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 2:49
 */

use app\components\Formatter;
use dektrium\user\models\SettingsForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет';
?>

        <div class="lk-main">
            <div class="settings">
                <div class="links">
                    <a href="<?=Url::to(['autofill'])?>">автозаполнение</a>
                    <a href="<?=Url::to(['security'])?>">безопасность</a>
                </div>
                <div class="auth-form">
                    <div class="a-title">смена пароля на сайте</div>

                  <?php
                  $model = \Yii::createObject(SettingsForm::className());
                  $form = ActiveForm::begin([
                      'id'          => 'account-form',
                      'fieldConfig' => [
                          'template'     => "{input}{error}\n{hint}",
                          'labelOptions' => ['class' => 'hidden'],
                      ],
                      'enableAjaxValidation'   => true,
                      'enableClientValidation' => false,
                      'action'=>['/user/settings/account'],
                  ]); ?>

                  <?= $form->field($model, 'email') ?>
                  <?= $form->field($model, 'new_password')->passwordInput(['placeholder'=>'Новый пароль']) ?>
                  <?= $form->field($model, 'current_password')->passwordInput(['placeholder'=>'Старый пароль']) ?>
                  <?= Html::submitInput('Сохранить') ?>

                  <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>