<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ExchangeDirectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exchange-direction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'currency_from') ?>

    <?= $form->field($model, 'currency_to') ?>

    <?= $form->field($model, 'course') ?>

    <?= $form->field($model, 'exchange_percent') ?>

    <?php // echo $form->field($model, 'min') ?>

    <?php // echo $form->field($model, 'max') ?>

    <?php // echo $form->field($model, 'min_comission') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
