<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Currency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'wallet')->textInput(['maxlength' => true])->label('Реквизит') ?>

    <?=$model->getImage() ? Html::img($model->getImage()->getUrl('20x')) :''?>

    <?= $form->field($model, 'icon')->fileInput() ?>

    <?= $form->field($model, 'reserve')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'USD'=>'USD',
        'RUR'=>'RUR',
        'UAH'=>'UAH',
        'btc'=>'BITCOIN',
        ''=>'Другое'
    ]) ?>

		<?= MultipleInput::widget([
						'max' => 10,
						'name'=>'CurrencyFields',
						'data'=>$model->fields,
						'columns' => [
								[
										'name'  => 'title',
										'type'  => 'textInput',
										'title' => 'Название поля',
								],

						]
				]);?>
	<?= $form->field($model, 'is_voucher')->checkbox()->label('Показывать поле для ввода ваучера?') ?>
	<?= $form->field($model, 'voucher_title')->textInput(['maxlength' => true])->label('Подсказка для поля кода ваучера') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
