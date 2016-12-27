<?php use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

	<div class="article-page">
	<div class="container">
	<h1><span>В</span>осстановление пароля</h1>


<?php $form = ActiveForm::begin([
		'id'                     => 'password-recovery-form',
		'enableAjaxValidation'   => true,
		'enableClientValidation' => false,
]); ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Новый пароль'])->label(false) ?>

<?= Html::submitButton(Yii::t('user', 'Готово'), ['class' => 'recovery-button']) ?><br>

<?php ActiveForm::end(); ?>
	</div>
	</div>
