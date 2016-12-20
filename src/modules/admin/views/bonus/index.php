<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 20.12.16
 * Time: 20:31
 */
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([

]); ?>

<?=MultipleInput::widget([
		'name'=>'bonus',
		'data'=>$models,
		'columns'=>[
				[
						'name'=>'from',
						'title'=>'от $'
				],
				[
						'name'=>'to',
						'title'=>'до $'
				],
				[
						'name'=>'percent',
						'title'=>'процент бонуса %'
				]
		]
])?>

<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>

<?php ActiveForm::end(); ?>
