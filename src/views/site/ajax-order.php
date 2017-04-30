<h6>Обмен <span id="fr"><?=$order->exchange->from->title?></span> на <span id="t"><?=$order->exchange->to->title?></span></h6>
<div class="sides">
	<div class="left">
		<b>Отдаю:</b>
		<div>
			<img src="<?=$order->exchange->from->getImage()->getUrl('x20')?>" alt="">
			<?=$order->from_value?> <?=$order->exchange->from->title?> <?=$order->exchange->from->type?>
            <small>Реквизит: <?=$order->exchange->from->wallet?></small>

		</div>
	</div>
	<div class="left">
		<b>Получаю:</b>
		<div>
			<img src="<?=$order->exchange->to->getImage()->getUrl('x20')?>" alt=""><?=$order->to_value?> <?=$order->exchange->to->title?> <?=$order->exchange->to->type?>
			<small>Счет: <?=$order->wallet?></small>
		</div>
	</div>
    <div class="full">
        <b>Email для оповещений:</b>
        <div>
            <?=$order->email?>
        </div>
    </div>
    <div class="chkbx ah-form-check">
        <input type="checkbox" id="acc" checked="checked" /> <label for="acc">Я ознакомился и согласен с <a href="#">правилами обмена</a> </label>
        <div class="clearfix"></div>
    </div>

    <div class="btns">
        <button id="closeTotDialog" class="ah-button ah-button-green">Отменить</button>
        <button id="totalBut" data-id="0" class="ah-button ah-button-orange">Я оплатил(а) заявку</button>
    </div>

</div>