<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 2:49
 */
use app\models\Currency;
use app\assets\AccountAsset;
use app\components\Formatter;
use yii\helpers\Html;

AccountAsset::register($this);

$this->title = 'Личный кабинет';
?>
		<div class="lk-main">
			<div class="bids-list"> 
				<!--<div class="bid-item">
					<div class="head">
						<div class="b-title">Заявка № 234567789</div>
						<div class="b-status">Оплата не подтверждена</div>
						<div class="b-date">20.10.2016</div>
						<div class="b-time">18:01:09</div>
					</div>
					<div class="body">
						<div class="left">
							<div class="ah-img"><img src="../img/icon/icon-02.png"></div>
							<div class="ah-currency-title">bitcoin</div>
						</div>
						<div class="center">
							<div class="ah-quantity">2 btc</div>
							<div class="ah-arrows"></div>
							<div class="ah-where">
								<div class="ah-img"><img src="../img/icon/icon-05.png"></div>
								<div class="ah-name">OKPAY</div>
								<p>Кошелек: ОК1235754346</p>
							</div>
						</div>						
						<div class="ah-price"><p>12463.45$</p></div>
					</div>
					<div class="foot">
						<div class="action"><a href="javascript:void(0)" class="history-remove" data-id="">Удалить из истории</a></div>
					</div>
				</div>-->
				<?php foreach($orders as $order): if(!$order->exchange){continue;} ?>
				<div class="bid-item">
					<div class="head">
						<div class="b-title">Заявка № <?=$order->id?></div>
						<?php if($order->status == 0): ?><div class="b-status">Отклонено</div><?php endif; ?>
                        <?php if($order->status == 2): ?><div class="b-status">Оплата не подтверждена</div><?php endif; ?>
                        <?php if($order->status == 3): ?><div class="b-status">Оплата подтверждена</div><?php endif; ?>
                        <?php if($order->status == 4): ?><div class="b-status">Выполнено <?=$order->voucher?'(ваучер: '.$order->voucher.')':''?></div><?php endif; ?>
						<div class="b-date"><?=$order->date?><?//=Yii::$app->formatter->asDate($order->date, 'php:d.m.Y')?></div>
						<div class="b-time"><?=$order->date?><?//=Yii::$app->formatter->asDate($order->date, 'php:H:i:s')?></div>
					</div>
					<div class="body">
						<div class="left">
							<div class="ah-img"><?php if($order->exchange): ?><?=$order->exchange->from->getImage() ? Html::img($order->exchange->from->getImage()->getUrl()) : ''?><?php endif; ?></div>
							<div class="ah-currency-title"><?php if($order->exchange): ?><?=$order->exchange->from->title?><?php endif; ?></div>
						</div>
						<div class="center">
							<div class="ah-quantity"><?=round($order->from_value, 2)?> <?=$order->exchange->from->type?></div>
							<div class="ah-arrows"></div>
							<div class="ah-where">
								<div class="ah-img"><?=$order->exchange->to->getImage() ? Html::img($order->exchange->to->getImage()->getUrl()) : ''?></div>
								<div class="ah-name"><?=$order->exchange->to->title?></div>
								<?php foreach($order->fields as $field): ?>
								<p><?=$field->field? $field->field->title:''?>: <?=$field?$field->value:''?></p>
                                <?php endforeach; ?>
							</div>
						</div>						
						<div class="ah-price"><p><?=round($order->to_value, 2)?> <?=$order->exchange->to->type?></p></div>
					</div>
					<div class="foot">
						<?php if($order->status == 2): ?>
						<div class="action"><a href="javascript:void(0)" class="i-pay" data-id="<?=$order->id?>">Я оплатил</a></div>
						<?php else:?>
						<div class="action"><a href="javascript:void(0)" class="history-remove" data-id="<?=$order->id?>">Удалить из истории</a></div>
						<?php endif;?>
					</div>
				</div>
				<?php endforeach; ?>
				
			</div><!-- /.bids -->
			<?php $currencies = Currency::find()->all(); $i = 1;?>
			<div class="currencies-list">						
			<?foreach($currencies as $currency):?>
				<?php if($i == 1){?>
				<div class="ah-group">
				<?php } ?>
					<div class="item">
						<div class="ah-img"><?=$currency->getImage() ? Html::img($currency->getImage()->getUrl()) : ''?></div>
						<div class="ah-name"><?=$currency->title?></div>
					</div>
				<?php if($i == 3){ $i = 0;?>
				</div>
				<?php }?>
			<?$i++;endforeach;?>
			</div>
		</div>

			</div>
		</section>
    </div>
</main>
