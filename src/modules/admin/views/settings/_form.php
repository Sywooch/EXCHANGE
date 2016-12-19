<?php

use nullref\admin\widgets\Flash;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
$model->type = 1;

Flash::begin();
echo "<p class='bg-info col-md-12'>Теги для почтовых писем: ".Html::encode('<SITEURL> - адрес сайта, <CREDENTIALS> - логин/пароль, <ORDERINFO> - инфо о заявке(ид, направление обмена, курс, сумма, дата), <ORDERSTATUS> - статус заявки')."</p>";
Flash::end();
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?php if($model->type == 1){
        echo $form->field($model, 'content')->widget(\mihaildev\ckeditor\CKEditor::className());
    } ?>

    <?php /*echo $form->field($model, 'type')->textInput(); */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
