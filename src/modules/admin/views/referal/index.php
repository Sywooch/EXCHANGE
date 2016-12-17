<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 17.12.16
 * Time: 3:56
 */
use app\models\ReferalOrder;
use yii\helpers\Html;

$this->title = 'Статистика рефералов';
?>



<h1>Статистика рефералов</h1>


<table class="table table-bordered">
	<thead>
	<tr>
		<td>Пользователь</td>
		<td>Рефералы</td>
		<td>Сумма</td>
		<td>Выплачено</td>
	</tr>
	</thead>
	<tbody>
	<?php foreach($users as $user): ?>
	<tr>
		<td><?=$user->referer->username?></td>
		<td><?php array_map(function($item){
				echo $item->user->username.'<br>';
			}, $user->referer->referals); ?>
		</td>
		<td>
			<?=$user->referer->getCountRefExchanges()['sumRur']*.006?> RUR
			(<?=$user->referer->getCountRefExchanges()['sumUsd']*.006?> USD)
		</td>
		<td>
			<?php array_map(function($item){
				echo Html::tag('p', $item->sum.' '.$item->currency->title.' '.$item->currency->type);
			}, $user->referer->getReferalOrders()->where(['status'=>ReferalOrder::STATUS_ACCEPTED])->all()) ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>
