<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 3:58
 */
$this->title = 'Личный кабинет';
?>


<div class="lk-main">
	<div class="top-text">Ваша реферальная ссылка для приглашения других пользователей:  <a href="http://<?=$_SERVER['HTTP_HOST']?>/?rid=14755865688186">http://<?=$_SERVER['HTTP_HOST']?>/?rid=<?=Yii::$app->user->id?></a></div>
	<div class="stat">
		<div class="col-1">
			<div class="param">Статистика на дату: <span class="value">За все время</span></div>
			<div class="param">Переходов по реферальной ссылке: <span class="value"><?=$incoming?></span></div>
			<div class="param">Зарегистрировалось: <span class="value"><?=Yii::$app->user->identity->getReferals()->count()?></span></div>
			<div class="param">Эффективность переходов: <span class="value"><?=Yii::$app->user->identity->getReferals()->count()/$incoming*100?>%</span></div>
		</div>
		<div class="col-2">
			<div class="param">Обмены с вознаграждением: <span class="value"><?=(int)$exchanges['count']?></span></div>
			<div class="param">Всего обменов: <span class="value"><?=(int)$exchanges['count']?></span></div>
			<div class="param">Эффективность обменов: <span class="value">100%</span></div>
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
                  //var_dump($referal->user);
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
                        <div class="value"><?=round($referal->user->getOrders()->sum('from_value')*.6, 4);?></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php endforeach; ?>
			</div>
			<div class="tab-content" id="tab-content-2">
				<div class="col col-1">
					<div class="param">Дата регистрации 2</div>
					<div class="value">21.03.2016</div>
				</div>
				<div class="col col-2">
					<div class="param">Электронная почта</div>
					<div class="value">POSHTA@MAIL.RU</div>
				</div>
				<div class="col col-3">
					<div class="param">Прибыль</div>
					<div class="value">1245</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tab-content" id="tab-content-3">
				<div class="col col-1">
					<div class="param">Дата регистрации 3</div>
					<div class="value">21.03.2016</div>
				</div>
				<div class="col col-2">
					<div class="param">Электронная почта</div>
					<div class="value">POSHTA@MAIL.RU</div>
				</div>
				<div class="col col-3">
					<div class="param">Прибыль</div>
					<div class="value">1245</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="actions">
		<div class="a-info">
			<div class="a-title">ваши заработанные средства от привлеченных пользователей</div>
			<div class="param">Всего рефералов <span class="value"><?=Yii::$app->user->identity->getReferals()->count()?></span></div>
			<div class="param green">Не было начислений</div>
			<div class="param">Общий заработок в (РУБ) <span class="value"><?=(int)$exchanges['sum']?></span></div>
			<div class="param">Или, он же в долларах: <span class="value"><?=(int)$exchanges['sum']?></span></div>
			<div class="hint">Заработок в (USD)</div>
		</div>
		<div class="create">
			<div class="a-title">Создать заявку на выплату</div>
			<select>
				<option>Платежная система</option>
				<option>Платежная система</option>
				<option>Платежная система</option>
			</select>
			<input type="text" placeholder="Кошелек для получения" />
			<input type="submit" value="Создать заявку" />
		</div>
		<div class="clearfix"></div>
	</div>
</div>
