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
?>


<div class="lk-main">
	<div class="top-text">Ваша реферальная ссылка для приглашения других пользователей:  <a href="http://<?=$_SERVER['HTTP_HOST']?>/?rid=14755865688186">http://<?=$_SERVER['HTTP_HOST']?>/?rid=<?=Yii::$app->user->id?></a></div>
	<div class="stat">
		<div class="col-1">
			<div class="param">Статистика на дату: <span class="value">За все время</span></div>
			<div class="param">Переходов по реферальной ссылке: <span class="value"><?=$incoming?></span></div>
			<div class="param">Зарегистрировалось: <span class="value"><?=Yii::$app->user->identity->getReferals()->count()?></span></div>
			<div class="param">Эффективность переходов: <span class="value"><?=$incoming ? Yii::$app->user->identity->getReferals()->count()/$incoming*100 : 0?>%</span></div>
		</div>
		<div class="col-2">
			<div class="param">Обмены с вознаграждением: <span class="value"><?=(int)$exchanges['count']?></span></div>
			<div class="param">Всего обменов: <span class="value"><?=(int)$exchanges['count']?></span></div>
			<div class="param">Эффективность обменов: <span class="value"><?=(int)$exchanges['count'] ? (int)$exchanges['count']/(int)$exchanges['count']*100 : 0?>%</span></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="stat-data">
		<div class="tabs">
			<div class="tab active" data-target-id="tab-content-1">Список рефералов</div>
			<div class="tab" data-target-id="tab-content-2">История начислений</div>
			<div class="tab" data-target-id="tab-content-3">Заявки на выплату</div>
			<div class="clearfix"></div>
		</div>
		<div class="data-content">
			<div class="tab-content active" id="tab-content-1">
                <?php foreach(Yii::$app->user->identity->getReferals()->all() as $referal):
                  $money = Yii::$app->user->identity->getCountRefExchanges($referal->referal_id);
                  ?>
				<div class="row">
                    <div class="col col-1">
                        <div class="param">Дата регистрации</div>
                        <div class="value"><?=Yii::$app->formatter->asDate($referal->user->created_at, 'php:d.m.Y')?></div>
                    </div>
                    <div class="col col-2">
                        <div class="param">Электронная почта</div>
                        <div class="value"><?=$referal->user->email?></div>
                    </div>
                    <div class="col col-3">
                        <div class="param">Прибыль</div>
                        <div class="value"><?=round($money['sumRur']*.006, 2)?> RUR (<?=round($money['sumUsd']*.006, 2)?> USD)</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php endforeach; ?>
			</div>
			<div class="tab-content" id="tab-content-2">
              <?php foreach(Yii::$app->user->identity->getReferals()->all() as $referal):
                foreach($referal->user->orders as $order): ?>
                  <div class="row">
                      <div class="col col-1">
                          <div class="param">Реферал</div>
                          <div class="value"><?=$referal->user->email?></div>
                      </div>
                      <div class="col col-2">
                          <div class="param">Обмен</div>
                          <div class="value"><?=$order->from_value.' '.$order->exchange->from->title?> => <?=$order->to_value.' '.$order->exchange->to->title?></div>
                      </div>
                      <div class="col col-3">
                          <div class="param">Начислено</div>
                          <div class="value"><?=$order->from_value*.006;?> <?=$order->exchange->from->type?></div>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              <?php endforeach; endforeach; ?>
			</div>
			<div class="tab-content" id="tab-content-3">
              <?php foreach(Yii::$app->user->identity->getReferalOrders()->where(['status'=>4])->all() as $order): ?>
                  <div class="row">
                      <div class="col col-1">
                          <div class="param">Дата</div>
                          <div class="value"><?=Yii::$app->formatter->asDate($order->date, 'php:d.m.Y H:i:s')?></div>
                      </div>
                      <div class="col col-2">
                          <div class="param">Сумма</div>
                          <div class="value"><?=$order->sum?></div>
                      </div>
                      <div class="col col-3">
                          <div class="param">Кошелек</div>
                          <div class="value"><?=$order->currency->title?> <?=$order->currency->type?></div>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              <?php endforeach; ?>
			</div>
			<div class="clearfix"></div>
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
            <?php $form = ActiveForm::begin([
                'action'=>Url::to('referal-order'),
                'options'=>['class'=>'create']
            ]) ?>
			<div class="a-title">Создать заявку на выплату</div>
			<select name="currency_id">
                <?php foreach ($currencies as $currency): ?>
				<option value="<?=$currency->id?>"><?=$currency->title?></option>
                <?php endforeach; ?>
			</select>
			<input type="text" name="wallet" placeholder="Кошелек для получения" />
			<input type="submit" value="Создать заявку" />
		<?php ActiveForm::end(); ?>
		<div class="clearfix"></div>
	</div>
</div>
