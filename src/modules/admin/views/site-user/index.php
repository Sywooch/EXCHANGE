<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 20.12.16
 * Time: 6:22
 */
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;

?>



<?=TabularInput::widget([
		'models'=>$models,
	'columns'=>[
			[
					'type'=>'static',
				'name'=>'static1',
				'title'=>'username',
					'value'=>function($model){
						return Html::tag('span', $model->username);
					}
			],
			[
					'type'=>'static',
					'name'=>'static2',
				'title'=>'email',
					'value'=>function($model){
						return Html::tag('span', $model->email);
					}
			],
			[
					'type'=>'static',
					'name'=>'static3',
					'title'=>'Заявки',
					'value'=>function($model){
						return Html::tag('span', $model->getOrders()->count());
					}
			],
			[
					'type'=>'static',
					'name'=>'static4',
					'title'=>'Рефералы',
					'value'=>function($model){
						return Html::tag('span', $model->getReferals()->count());
					}
			],
			[
					'type'=>'static',
					'name'=>'static5',
					'title'=>'Рефералы на сумму',
					'value'=>function($model){
						return Html::tag('span', $model->getCountRefExchanges()['sumRur'].' RUR')
								.Html::tag('span', ' ('.$model->getCountRefExchanges()['sumUsd'].' USD)');
					}
			],
	]
])?>
