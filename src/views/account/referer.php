<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 3:58
 */
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет';
$count = intval(Yii::$app->user->identity->getReferals()->count());
?>


<div class="lk-main">
	<div class="ah-top-text">Ваша реферальная ссылка для приглашения других пользователей:  <a href="http://<?=$_SERVER['HTTP_HOST']?>/?rid=14755865688186">http://<?=$_SERVER['HTTP_HOST']?>/?rid=<?=Yii::$app->user->id?></a></div>

	<div class="stat">
		<div class="stat-data">
			<div class="param">Статистика на дату: <span class="value">За все время</span></div>
			<div class="param">Переходов по реферальной ссылке: <span class="value"><?=$incoming?></span></div>
			<div class="param">Зарегистрировалось: <span class="value"><?=Yii::$app->user->identity->getReferals()->count()?></span></div>
			<div class="param">Эффективность переходов: <span class="value"><?php echo ($count != 0 ? 100*intval($incoming)/$count.'%' : '0%')?></span></div>
			<div class="param">Обмены с вознаграждением: <span class="value"><?=(int)$exchanges['count']?></span></div>
			<div class="param">Всего обменов: <span class="value"><?=(int)$exchanges['count']?></span></div>
			<div class="param">Эффективность обменов: <span class="value"><?=(int)$exchanges['count'].'%'?></span></div>
		</div>
		<div class="ah-table">
			<div class="tabs">
				<div class="tab active" data-target-id="tab-content-1">Список рефералов</div>
				<div class="tab" data-target-id="tab-content-2">История начислений</div>
				<div class="tab" data-target-id="tab-content-3">Заявки на выплату</div>
			</div>
			<div class="tabs-data">
				<div class="tab-content active" id="tab-content-1">
					<div class="ah-main-line">
						<div class="ah-value">Дата регистрации</div>
						<div class="ah-value">Электронная почта</div>
						<div class="ah-value">Прибыль</div>
					</div>
					<div class="ah-line">
						<div class="ah-value">15.02.2016</div>
						<div class="ah-value">Jackass@gmail.com</div>
						<div class="ah-value">56842 USD</div>
					</div>
					<?php foreach(Yii::$app->user->identity->getReferals()->all() as $referal):
						$money = Yii::$app->user->identity->getCountRefExchanges($referal->referal_id);
					?>
					<div class="ah-line">
						<div class="ah-value"><?=$referal->user->created_at?></div>
						<div class="ah-value"><?=$referal->user->email?></div>
						<div class="ah-value"><?=round($money['sumRur']*.006, 2)?> RUR (<?=round($money['sumUsd']*.006, 2)?> USD)</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="tab-content" id="tab-content-2">
					<div class="ah-main-line">
						<div class="ah-value">Реферал</div>
						<div class="ah-value">Обмен</div>
						<div class="ah-value">Начислено</div>
					</div>
					<div class="ah-line">
						<div class="ah-value">Jackass@gmail.com</div>
						<div class="ah-value">100 btc => 2000 USD</div>
						<div class="ah-value">56842 USD</div>
					</div>
					<?php foreach(Yii::$app->user->identity->getReferals()->all() as $referal):
						foreach($referal->user->orders as $order): if(!$order->exchange){continue;} ?>
					<div class="ah-line">
						<div class="ah-value"><?=$referal->user->email?></div>
						<div class="ah-value"><?=$order->from_value.' '.$order->exchange->from->title?> => <?=$order->to_value.' '.$order->exchange->to->title?></div>
						<div class="ah-value"><?=$order->from_value*.006;?> <?=$order->exchange->from->type?></div>
					</div>
					<?php endforeach; endforeach; ?>
				</div>
				<div class="tab-content" id="tab-content-3">
					<div class="ah-main-line">
						<div class="ah-value">Дата</div>
						<div class="ah-value">Сумма</div>
						<div class="ah-value">Кошелек</div>
					</div>
					<div class="ah-line">
						<div class="ah-value">15.02.2016</div>
						<div class="ah-value">56842</div>
						<div class="ah-value">RA5684246998734</div>
					</div>
					<?php foreach(Yii::$app->user->identity->getReferalOrders()->where(['status'=>4])->all() as $order): ?>
					<div class="ah-line">
						<div class="ah-value"><?=Yii::$app->formatter->asDate($order->date, 'php:d.m.Y H:i:s')?>6</div>
						<div class="ah-value"><?=$order->sum?></div>
						<div class="ah-value"><?=$order->currency->title?> <?=$order->currency->type?></div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

	</div>
	
	<div class="actions">
		<div class="a-info">
			<div class="a-title">ваши заработанные средства от привлеченных пользователей</div>
			<div class="param">Всего рефералов <span class="value"><?=Yii::$app->user->identity->getReferals()->count()?></span></div>
			<div class="param green">Не было начислений</div>
			<div class="param">Общий заработок в (РУБ) <span class="value"><?=(int)$exchanges['sumRur']*.006?></span></div>
			<div class="param">Или, он же в долларах: <span class="value"><?=(int)$exchanges['sumUsd']*.006?></span></div>
			<div class="hint">Заработок в (USD)</div>
		</div>
        <div class="ah-panel ah-panel-blue">
            <div class="ah-header">
                <h4>СОЗДАТЬ ЗАЯВКУ НА ВЫПЛАТУ</h4>
            </div>
            <div class="ah-content">
                <?php $form = ActiveForm::begin([
                    'action'=>Url::to('referal-order'),
                    'options'=>['class'=>'create']
                ]) ?>
                <div class="ah-form-select">
                    <select name="currency_id">
                        <option value="" selected>Платежная система</option>
                        <?php foreach ($currencies as $currency): ?>
                        <option value="<?=$currency->id?>"><?=$currency->title?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="select"></div>
                </div>
                <div class="ah-form-field">
                    <input type="text" name="wallet" placeholder="Кошелек для получения" />
                </div>
                <div class="ah-form-submit">
                    <input type="submit" class="ah-button ah-button-orange" value="СОЗДАТЬ ЗАЯВКУ" />
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
	</div>
</div>

			</div>
		</section>
    </div>
</main>
