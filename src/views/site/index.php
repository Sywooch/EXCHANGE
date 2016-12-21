<?php
use app\assets\NgAppAsset;
use app\models\User;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
Yii::$app->formatter->locale = 'ru-RU';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}

NgAppAsset::register($this); ?>


<?php if(!Yii::$app->user->isGuest): ?>
<script>
    var user = <?=Json::encode(Yii::$app->user->identity);?>;
    user.fields = <?=Json::encode(Yii::$app->user->identity->wallets);?>;
</script>
<?php endif; ?>

<style>
    .bid {
        transition: all .5s;
    }
    [ng-cloak] {
        opacity: 0!important;
        display: block !important;
    }
</style>
<div class="bid" ng-app="ExchangeApp" ng-cloak>
    <div class="container" ng-controller="FormController">
        <div class="bid-block">
            <div class="info-wrapper">
                <div class="info">
                    <div class="mob-info">
                        <div class="capt">1 USD = 62.35 RUR, 1 BTC = 614.846 USD, 1 LTC = 3.8435 USD, 1 ETH = 12.51 USD</div>
                        <label>У вас есть</label>
                        <select>
                            <?php foreach($currency as $item): ?>
                            <option data-image="<?=$item->getImage()?$item->getImage()->getUrl():''?>"><?=$item->title?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Можете олучить</label>
                        <select>
                            <option data-image="./img/visa-ico.png">Visa/MasterCard RUB</option>
                        </select>
                        <div class="reserve">Резерв 2 939 111.55 RUR</div>
                        <div class="unit">1 BTC-е USD = 60.9807 QIWI RUR</div>
                    </div>
                    <div class="col-1">
                        <div class="head">У Вас есть</div>
                        <div class="rows">

                            <div ng-repeat="item in currencies" class="row value" ng-class="{active: activeCurrency.id == item.id}" ng-mouseenter="changeCurrency(item)">
                                <div class="image"><div><img ng-src="{{item.ajaxIcon}}" alt=""></div></div>
                                <div class="amount">1.0000 {{item.title}} {{item.type}}</div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>

                    <div class="col-2">
                        <div class="head">Вы можете получить</div>
                        <div class="rows">

                            <div class="row" ng-repeat="direction in filteredDirections = (directions | filter:{'currency_from': activeCurrency.id}:true)" ng-class="{active:directionActive.id == direction.id}" ng-mouseenter="changeDirection(direction)">
                                <div class="image"><div><img ng-src="{{direction.ajaxIcon}}" alt=""></div></div>
                                <div class="amount">{{direction.courseCounted}} {{direction.currencyTitle}} {{direction.currencyType}}</div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>
                        <div class="col-3">
                            <div class="head">Получаете Резерв</div>
                            <div class="rows-">
                                <div class="row" ng-repeat="reserve in filteredDirections" ng-class="{active:directionActive.id == reserve.id}" ng-mouseenter="changeDirection(reserve)">
                                    <div class="reserve">{{reserve.currencyReserve}}</div>
                                </div>
                            </div>
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.info -->
            <form class="form order-form" action="<?=Url::to(['site/process-order'])?>">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <div class="head">Оформить заявку</div>
                <div class="fields">
                    <div class="row">
                        <select id="cur_from" name="exchange_from_id">
                            <?php foreach($currency as $item): ?>
                                <option value="<?=$item->id?>" data-image="<?=$item->getImage()?$item->getImage()->getUrl():''?>"><?=$item->title?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="amount">
                            <input required type="text" name="from_value" id="from_value_input" ng-change="exchange_to = countExchangeResult()" ng-model="exchange_from" placeholder="min {{directionActive.min}}" />
                            <div class="currency">{{directionActive.from.type}}</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <select id="cur_to" name="exchange_to_id">
                            <option ng-repeat="curr in directions | filter:{'currency_from': activeCurrency.id}:true" value="{{curr.currency_to}}" data-image="{{curr.ajaxIcon}}">{{curr.currencyTitle}}</option>
                        </select>
                        <div class="amount">
                            <input required type="text" name="to_value" id="to_value_input" ng-model="exchange_to" placeholder="0" />
                            <div class="currency">{{directionActive.to.type}}</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="hint">По курсу: <span id="form_course"></span> 1.0000 {{directionActive.from.type}} {{directionActive.from.title}} = {{directionActive.course}} {{directionActive.to.type}} {{directionActive.to.title}}</div>
                    <!--<div class="row">
                        <input required type="text" name="card" placeholder="Номер карты" class="full" />
						<button class="btcross">+</button>
						
                    </div>
                    <div class="row">
                        <input required type="text" name="bank" placeholder="Название банка" class="full" />
						<button class="btcross">+</button>
                    </div>-->
                    <!--<div class="row">
                        <input required type="text" name="wallet" placeholder="Кошелек для получения" class="full" />
                        <button class="btcross">+</button>
                    </div>-->
                    <div class="row" ng-repeat="field in directionActive.to.fields.concat(directionActive.from.fields)">
                        <input required type="text" name="orderField[{{field.id}}]" placeholder="{{field.title}}" class="full" />
                        <?php if(Yii::$app->user->id): ?><button class="btcross">+</button><?php endif; ?>
                    </div>
                    <div class="row">
                        <input required type="text" name="fio" placeholder="ФИО отправителя" class="full" />
                    </div>
                    <div class="row">
                        <input required type="text" name="email" placeholder="Ваш Email" class="full" />
                        <?php if(Yii::$app->user->id): ?><button class="btcross">+</button><?php endif; ?>
                    </div>
                    <input required type="hidden" name="ip" value="<?=$ip != '::1' ? $ip : '95.31.18.119'?>">
                    <input required type="hidden" name="user_id" value="<?=Yii::$app->user->id?>">
                    <div class="agree">
                        <input required type="checkbox" id="ch" /> <label for="ch">Я согласен с правилами обмена</label>
                    </div>
                    <div class="control">
                        <button>Перейти к оплате</button>
                    </div>
                </div>
            </form><!-- /.form -->
            <div class="clearfix"></div>
        </div>
        <div class="link">
            <a id="tosecond" href="#second">&nbsp;</a>
        </div>
    </div>
</div>

<div id="second" class="info-block">
    <div class="container">
        <div class="block">
            <div class="title">Последние обмены</div>
            <div class="last-changes scrollbar">
                <?php
                $placeholder =  Yii::getAlias('@webroot').'/images/placeholder.png';
                foreach($orders as $order):
                  if($order->exchange):
                  ?>
                <div class="last-change">
                    <div class="transaction">
                        <div>
                            <div class="image"><?=!is_null($order->exchange->from) ? Html::img($order->exchange->from->getImage()->getUrl()) : Html::img($placeholder)?></div>
                            <div class="name"><?=$order->exchange->from->title?></div>
                            <div class="clearfix"></div>
                        </div>
                        <div>
                            <div class="image"><?=$order->exchange->to->getImage() ? Html::img($order->exchange->to->getImage()->getUrl()) : ''?></div>
                            <div class="name"><?=$order->exchange->to->title?></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="info"><?=$order->getLocation('img')?> <?=$order->getLocation('name')?>, <?=Yii::$app->formatter->asRelativeTime($order->date)?></div>
                </div>
                <?php endif;
                endforeach; ?>
            </div>
        </div>
        <div class="block">
            <div class="title">Статистика</div>
            <div class="stat">
                <div class="counter"><?=User::find()->count()?></div>
                <div class="name">Зарегистрировано пользователей</div>
            </div>
        </div>
        <div class="block">
            <div class="title">Отзывы</div>
            <div class="comments owl-carousel">
                <?php foreach($testimonials as $testimonial): ?>
                <div class="item">
                    <div class="avatar"><?=$testimonial->getImage() ? Html::img($testimonial->getImage()->getUrl()) : ''?></div>
                    <div class="name"><?=$testimonial->name?></div>
                    <div class="date"><?=Yii::$app->formatter->asDate($testimonial->date); ?></div>
                    <div class="text"><?=$testimonial->content?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="link"><a href="#" id="comment_dialog_btn">Оставить отзыв</a></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div><!-- /.info-block -->

<div class="how-work">
    <div class="container">
        <div class="title">Как это работает?</div>
        <div class="descr">Конвертируйте валюту в другую с наименьшими потерями!</div>
        <div class="text scrollbar">
            <div class="text-wrapper">
                <?=\yii\helpers\Html::decode(\app\models\Settings::findOne(['slug'=>'how_it_works'])['content'])?>
            </div>
        </div>
    </div>
</div><!-- /.how-work -->


<div id="comment_dialog">
    <div class="d-title">Оставить отзыв</div>
    <form action="<?=Url::to(['site/testimonial'])?>" method="post" class="ajax-form">
        <p>
			<label for="avatar">Ваше фото</label>
			<div class="btadd">Выберите файл
				<input required type="file" name="avatar" id="avatar">
			</div>
        </p>
        <input required type="text" placeholder="Как Вас зовут" name="name" />
        <input required type="text" placeholder="Email" name="email" />
        <textarea placeholder="Ваш отзыв" name="content"></textarea>
        <input required type="hidden" name="enabled" value="1">
        <input required type="hidden" name="date" value="<?=date('Y-m-d')?>">
        <input required type="submit" value="Отправить" />
    </form>
</div>

<div id="tot_dialog">
    <form action="">
    <h5>Мы зарезервировали для вас средства на 30 минут. Переведите <div id="total"></div></h5>
    <div id="voucher" class="hidden"><input type="text" id="voucher_input" name="voucher_code" placeholder="" required></div>
    <button id="totalBut" data-id="0">Я оплатил(а) заявку</button>
    </form>
</div>


<div id="success_modal">
        <h5>Ваша заявка принята в обработку</h5>
</div>