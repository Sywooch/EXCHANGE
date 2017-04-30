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
                            <a href="<?=Url::to(['autofill'])?>"><button class="ah-button ah-button-orange">автозаполнение</button></a>
                            <a href="<?=Url::to(['security'])?>"><button class="ah-button ah-button-orange">безопасность</button></a>
                        </div>
                        <div class="ah-panel ah-panel-blue">
                            <div class="ah-header">
                                <h4>СМЕНА ПАРОЛЯ НА САЙТЕ</h4>
                            </div>
                            <div class="ah-content">
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
                                <div class="ah-form-field">
                                    <?= $form->field($model, 'email') ?>
                                </div>
                                <div class="ah-form-field">
                                    <?= $form->field($model, 'new_password')->passwordInput(['placeholder'=>'Новый пароль']) ?>
                                </div>
                                <div class="ah-form-field">
                                    <?= $form->field($model, 'current_password')->passwordInput(['placeholder'=>'Старый пароль']) ?>
                                </div>
                                <div class="ah-form-submit">
                                    <?= Html::submitInput('СОХРАНИТЬ', ['class' => 'ah-button ah-button-orange']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
        
            </div>
		</section>
    </div>
</main>