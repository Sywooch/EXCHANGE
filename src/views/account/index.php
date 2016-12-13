<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 2:49
 */

use app\components\Formatter;
use yii\helpers\Html;

$this->title = 'Личный кабинет';
?>

		<div class="lk-main">
			<div class="bids-list">
                <?php foreach($orders as $order): ?>
				<div class="bid-item">
					<div class="b-head">
						<div class="b-title">Заявка № <?=$order->id?></div>
						<?php if($order->status == 1): ?><div class="b-status">Новая заявка</div><?php endif; ?>
						<div class="b-time">
							<span class="date"><?=Yii::$app->formatter->asDate($order->date, 'php:d.m.Y')?></span>
							<span class="time"><?=Yii::$app->formatter->asDate($order->date, 'php:H:m:s')?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="b-info">
						<div class="from">
							<div class="image"><?=$order->exchange->from->getImage() ? Html::img($order->exchange->from->getImage()->getUrl()) : ''?></div>
							<div class="name"><?=$order->exchange->from->title?></div>
							<div class="clearfix"></div>
						</div>
						<div class="from-amount"><?=round($order->from_value, 2)?> <?=$order->exchange->from->type?></div>
						<img src="/img/bid-direction.png" style="height: 18px; width: 15px; float: left; margin: 5px 31px 0 0;"/>
						<div class="to">
							<div class="image"><?=$order->exchange->to->getImage() ? Html::img($order->exchange->to->getImage()->getUrl()) : ''?></div>
							<div class="to-info">
								<div class="name"><?=$order->exchange->to->title?></div>
								<div class="wallet">Кошелек: <?=$order->wallet?></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="to-amount"><?=round($order->to_value, 2)?> <?=$order->exchange->to->type?></div>
						<div class="clearfix"></div>
					</div>
					<div class="action"><a href="#">Удалить из истории</a></div>
				</div>
				<?php endforeach; ?>
			</div><!-- /.bids -->
		</div>