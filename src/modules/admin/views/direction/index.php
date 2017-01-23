<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 21:53
 */
use unclead\multipleinput\MultipleInput;
use yii\widgets\ActiveForm;


?>

<div class="admin-index">
<div class="row">
<div class="col-lg-12">
	<h2 class="page-header">Направления обмена</h2>

	<nav>
		<?php foreach($currency as $item): ?>
			<a class="btn btn-sm btn-<?=$item->id == $cur->id ? 'info':'default'?>" href="<?=\yii\helpers\Url::to(['direction/index', 'currency_from'=>$item->id])?>"><?=$item->title?> <?=$item->type?></a>
		<?php endforeach; ?>
	</nav>

	<?php
    $currencies = [];
    foreach(\app\models\Currency::find()->all() as $currency){
        $currencies[$currency->id] = $currency->title.' '.$currency->type;
    }

    $form = ActiveForm::begin(); ?>

	<?= MultipleInput::widget([
			'max' => 50,
			'name'=>'directions',
			'data'=>$directions,
			'columns' => [
					[
							'name'  => 'static',
							'type'  => 'static',
							'value' => function($data) use ($cur) {
								return \yii\helpers\Html::tag('h5', $cur->title. ' ' .$cur->type, ['class' => '']);
							},
							'title' => 'Обмен с',
					],
					[
							'name'  => 'currency_to',
							'type'  => 'dropDownList',
							'title' => 'на',
							'items' => $currencies
					],
					[
							'name'  => 'course',
							'type'  => 'textInput',
							'title' => 'курс',
							'defaultValue'=>'1.00',
							'headerOptions' => [
									'style' => 'width: 100px;',
							]
					],
					[
							'name'  => 'exchange_percent',
							'type'  => 'textInput',
							'title' => 'проценты (%)',
							'defaultValue'=>'1',
							'headerOptions' => [
									'style' => 'width: 70px;',
							]
					],
					[
							'name'  => 'min',
							'type'  => 'textInput',
							'title' => 'мин.сумма',
							'defaultValue'=>'1',
							'headerOptions' => [
									'style' => 'width: 150px;',
							]
					],
					[
							'name'  => 'max',
							'type'  => 'textInput',
							'title' => 'макс.сумма',
							'defaultValue'=>'100000',
							'headerOptions' => [
									'style' => 'width: 150px;',
							]
					],
					[
							'name'  => 'min_comission',
							'type'  => 'textInput',
							'title' => 'мин.комиссия',
							'defaultValue'=>'1',
							'headerOptions' => [
									'style' => 'width: 70px;',
							]
					],
					[
							'name'  => 'enabled',
							'type'  => 'checkbox',
							'title' => 'вкл',
							'defaultValue'=>'1',
							'headerOptions' => [
									'style' => 'width: 70px;',
							]
					],

			]
	]);
	?>
	<div class="form-group">
		<?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-success' ]) ?>
	</div>
	<?php ActiveForm::end(); ?>

</div>
</div></div>