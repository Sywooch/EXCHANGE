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
<main class="bid" ng-app="ExchangeApp" ng-cloak>
            <div class="ah-wrapper">
                <section ng-controller="FormController">
                    <div class="ah-border">
                        <div class="ah-select ah-row-3">
                            <div class="ah-give">
                                <div class="ah-header">
                                    <h6>ОТДАДИТЕ</h6>
                                </div>
                                <div class="ah-content">
                                    <ul class="scrollbar">
                                        <li ng-repeat="item in currencies" class="row value" ng-class="{active: activeCurrency.id == item.id}" ng-click="changeCurrency(item)">
											<i class="ah-icon ah-icon-01" style="background-image:url({{item.ajaxIcon}});"></i>
											{{item.title}} {{item.type}}
										</li>                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="ah-get">
                                <div class="ah-header">
                                    <h6>ПОЛУЧИТЕ</h6>
                                </div>
                                <div class="ah-content">
                                    <ul class="scrollbar">
                                        <li class="row" ng-repeat="direction in filteredDirections = (directions | filter:{'currency_from': activeCurrency.id}:true)" ng-class="{active:directionActive.id == direction.id}" ng-click="changeDirection(direction)">
											<i class="ah-icon ah-icon-02" style="background-image:url({{direction.ajaxIcon}});"></i>
											{{direction.courseCounted}} {{direction.currencyTitle}} {{direction.currencyType}}
										</li>
									</ul>
                                </div>
                            </div>
                            <div class="ah-reserve">
                                <div class="ah-header">
                                    <h6>РЕЗЕРВ</h6>
                                </div>
                                <div class="ah-content">
                                    <ul class="scrollbar">
                                        <li ng-repeat="reserve in filteredDirections" ng-class="{active:directionActive.id == reserve.id}" ng-click="changeDirection(reserve)">
											{{reserve.currencyReserve}}
										</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ah-application">
                            <div class="ah-header">
                                <h5>ОФОРМИТЬ ЗАЯВКУ</h5>
                            </div>
                            <div class="ah-content">
                                <form class="form order-form" action="<?=Url::to(['site/process-order'])?>"
										data-course="{{directionActive.course}}"
										data-course-counted="{{directionActive.courseCounted}}"
										data-min="{{directionActive.min}}"
										data-max="{{directionActive.max}}"
										data-comission="{{directionActive.min_comission}}">
									<input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                                    <div class="ah-row-2"><span>Отдаю</span><span><i class="ah-icon ah-icon-05" data-image="{{curr.ajaxIcon}}"></i>{{directionActive.from.title}} {{directionActive.from.type}}</span></div>									
                                    <select id="cur_from" name="exchange_from_id" style="display: none;">
											<option value="">Выберите валюту</option>
										<?php foreach($currency as $item): ?>
											<option value="<?=$item->id?>" data-image="<?=$item->getImage()?$item->getImage()->getUrl():''?>"><?=$item->title?></option>
										<?php endforeach; ?>
									</select>
									<div class="ah-form-field">
                                        <input required type="text" placeholder="Сколько {{directionActive.min}}" name="from_value" id="from_value_input" ng-change="exchange_to = countExchangeResult()" ng-model="exchange_from">
                                    </div>
                                    <div class="ah-row-2"><span>Хочу купить</span><span><i class="ah-icon ah-icon-09"></i>{{directionActive.to.title}} {{directionActive.to.type}}</span></div>
									<select id="cur_to" name="exchange_to_id" style="display: none;">
										<option value="">Выберите валюту</option>
										<option ng-repeat="curr in directions | filter:{'currency_from': activeCurrency.id}:true" value="{{curr.currency_to}}" data-image="{{curr.ajaxIcon}}">{{curr.currencyTitle}}</option>
									</select>
                                    <div class="ah-form-field">
                                        <input required type="text" placeholder="Сколько" name="to_value" id="to_value_input" ng-model="exchange_to" ng-change="exchange_from = countExchangeFrom()">
                                    </div>
                                    <div class="ah-text-center"><span>По курсу: 1.00000 = <!--= 123456-->{{directionActive.courseCounted}}</span></div>
									<div class="city ah-hidden" ng-show="directionActive.to.id == 25">
										<select name="cash" id="citySelect">
											<option value="">Выберите город</option>
											<option value="Харьков">Харьков</option>
											<option value="Киев">Киев</option>
											<option value="Днепропетровск">Днепропетровск</option>
											<option value="Москва">Москва</option>
										</select>
									</div>
									<div class="ah-form-field row" ng-repeat="field in directionActive.to.fields.concat(directionActive.from.fields)" style="position: relative;">
										<input required type="text" name="orderField[{{field.id}}]" placeholder="{{field.title}}" class="full" />
										<?php if(Yii::$app->user->id): ?><button class="btcross">+</button><?php endif; ?>
									</div>
                                    <div class="ah-form-field">
                                        <input required type="tel" placeholder="Контактный номер телефона" name="phone">
                                    </div>
                                    <div class="ah-form-field">
                                        <input required type="text" placeholder="Куда отправить деньги" name="wallet">
                                    </div>
                                    <div class="ah-form-field">
                                        <input required type="text" placeholder="ФИО отправителя" name="fio">
                                    </div>
                                    <div class="ah-form-field" style="position: relative;">
                                        <input required type="email" placeholder="Ваш Email" name="email">
										<?php if(Yii::$app->user->id): ?><button class="btcross">+</button><?php endif; ?>
                                    </div>
									<input required type="hidden" name="ip" value="<?=$ip != '::1' ? $ip : '95.31.18.119'?>">
									<input required type="hidden" name="user_id" value="<?=Yii::$app->user->id?>">
                                    <div class="ah-form-check">
                                        <input required type="checkbox" id="form-accept">
                                        <label for="form-accept">С согласен с правилами обмена</label>
                                    </div>
                                    <div class="ah-form-submit control">
                                        <!--<input class="ah-button ah-button-orange" type="submit" value="ПЕРЕЙТИ К ОПЛАТЕ">-->
										<button class="ah-button ah-button-orange">ПЕРЕЙТИ К ОПЛАТЕ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="info-block ah-row-3 ah-space_between">
                        <div class="ah-panel ah-panel-blue">
                            <div class="ah-header">
                                <h4>ПОСЛЕДНИЕ ОБМЕНЫ</h4>
                            </div>
                            <div class="ah-content ">
								<ul class="scrollbar">
									<?php
									$placeholder =  Yii::getAlias('@webroot').'/images/placeholder.png';
									foreach($orders as $order):
									  if($order->exchange && $order->exchange->from && $order->exchange->to):
										$style1 = !is_null($order->exchange->from) ? $order->exchange->from->getImage()->getUrl() : $placeholder;
										$style2 = $order->exchange->to->getImage() ? $order->exchange->to->getImage()->getUrl() : '';
										$style3 = $order->getLocation('imgUrl');
									  ?>
                                    <li>
                                        <div class="ah-arrow">
											<span><i class="ah-icon ah-icon-01" <?php echo 'style="background-image:url('.$style1.');"';?>></i><?=$order->exchange->from->title?></span>
											<span><i class="ah-icon ah-icon-04" <?php echo 'style="background-image:url('.$style2.');"';?>></i><?=$order->exchange->to->title?></span>
										</div>
                                        <div><i class="ah-icon ah-icon-ukraine" <?php echo 'style="background-image:url('.$style3.');"';?>></i><?=$order->getLocation('name')?>, <?=Yii::$app->formatter->asRelativeTime($order->date)?></div>
                                    </li>
									<?php endif;
									endforeach; ?>
                                    <!--<li>
                                        <div class="ah-arrow"><span><i class="ah-icon ah-icon-01"></i>1.00 Perfectmoney USD</span><span><i class="ah-icon ah-icon-04"></i>58.7876085 Яндекс.Деньги RUR</span></div>
                                        <div><i class="ah-icon ah-icon-ukraine"></i>Украина, 15 часов назад</div>
                                    </li>
                                    <li>
                                        <div class="ah-arrow"><span><i class="ah-icon ah-icon-01"></i>1.00 Perfectmoney USD</span><span><i class="ah-icon ah-icon-04"></i>58.7876085 Яндекс.Деньги RUR</span></div>
                                        <div><i class="ah-icon ah-icon-ukraine"></i>Украина, 15 часов назад</div>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="ah-panel ah-panel-green">
                            <div class="ah-header">
                                <h4>СТАТИСТИКА</h4>
                            </div>
                            <div class="ah-content ah-bg-nah">
                                <div class="ah-counter">
									<input type="hidden" value="<?=User::find()->count()?>">
                                    <!--<img src="img/counter.png" />-->
									<div id="counter">
										<?php $numCounter = User::find()->count();?>
										<div class="num"><span><?=$numCounter[0]?></span></div>
										<div class="num"><span><?=$numCounter[1]?></span></div>
									</div>
                                </div>
                                <div class="ah-text">
                                    <p>Пользователь<br />зарегистрирован на<br /><span class="ah-green"><?=date('h:s d.m.Y',User::find()->one()->last_login_at)?></span></p>
                                </div>
                                <div>
                                    <button class="ah-button ah-button-green js-button-register">ЗАРЕГИСТИРОВАТЬСЯ</button>
                                </div>
                            </div>
                        </div>
                        <div class="ah-panel ah-panel-green2 ah-reviews">
                            <div class="ah-header">
                                <h4 class="ah-arrows">ОТЗЫВЫ</h4>
                            </div>
                            <div class="ah-content scrollbar">
								<?php foreach($testimonials as $testimonial): ?>
                                <div class="ah-comment ah-row">
                                    <div class="ah-img"><!--<img src="img/img-women.png">--><?=$testimonial->getImage() ? Html::img($testimonial->getImage()->getUrl('79x79')) : ''?></div>
                                    <div class="ah-text">
                                        <p class="ah-name"><?=$testimonial->name?></p><span class="ah-date"><?=$testimonial->date; ?></span>
                                        <p><?=$testimonial->content?></p>
                                    </div>
                                </div>
								<?php endforeach; ?>
                                <!--<div class="ah-comment ah-row">
                                    <div class="ah-img"><img src="img/img-man.png"></div>
                                    <div class="ah-text">
                                        <p class="ah-name">Oleg</p><span class="ah-date">21 января 2017</span>
                                        <p>Меняю у вас постоянно, спасибо за бесперебойную работу</p>
                                    </div>
                                </div>-->
                            </div>
                            <div class="ah-footer">
                                <button id="comment_dialog_btn" class="ah-button-comment js-button-comment">ОСТАВИТЬ ОТЗЫВ</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
                <section>
            <div class="ah-wrapper">
                <div class="ah-how">
                    <div class="ah-header">
                        <h2>КАК ЭТО РАБОТАЕТ?</h2><span>Конвертируйте валюту в другую с наименьшими потерями!</span>
                    </div>
                    <div class="ah-row-3">
                        <div class="ah-content">
                            <p>С помощью нашего сервиса очень просто сделать обмен электронной валюты</p>
                            <p>Мы готовы предоставить нашим клиентам сервис высокого уровня и оперативность в оказании услуг. Кроме 100 % гарантии сохранности получаемых нами средств, мы обеспечиваем круглосуточную поддержку своих клиентов и стараемся сделать процесс перевода и обмена проще, оступнее, понятнее.</p>
                            <p>Мы предоставляем услуги на высоком уровне обслуживания. Это касается абсолютно всех сделок с виртуальными валютами, которые проходят через наш сервис.</p>
                            <p>Наш сайт оборудован понятным интерфейсом, мы стараемся предложить своим клиентам максимально выгодные курсы обмена, а так же учитываем все пожелания и замечания.</p>
                        </div>
                        <div class="ah-shkaf">
                            <i class="ah-icon ah-icon-01"></i><i class="ah-icon ah-icon-02"></i><i class="ah-icon ah-icon-03"></i><i class="ah-icon ah-icon-04"></i><i class="ah-icon ah-icon-05"></i><i class="ah-icon ah-icon-06"></i><i class="ah-icon ah-icon-07"></i><i class="ah-icon ah-icon-08"></i><i class="ah-icon ah-icon-09"></i><i class="ah-icon ah-icon-10"></i><i class="ah-icon ah-icon-11"></i><i class="ah-icon ah-icon-12"></i>
                        </div>
                        <div class="ah-advanced">
                            <div class="ah-logo">
                                <a href="index.html">
                                    <img src="img/logo-big.png" />
                                </a>
                            </div>
                            <div class="ah-register">
                                <button class="ah-button ah-button-green js-button-register">ЗАРЕГИСТИРОВАТЬСЯ</button>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="ah-header ah-text-left">
                        <h4>ВЫ МОЖЕТЕ ПОЛУЧИТЬ У НАС КВАЛИФИЦИРОВАННУЮ</h4>ПОДДЕРЖКУ, ЕСЛИ ВАМ ТРЕБУЕТСЯ:
                    </div>
                    <div class="ah-content">
                        <ul>
                            <li>
                                <div class="ah-img">
                                    <img src="img/icon/icon-change-01.png" /></div>
                                <div class="ah-text"><span>совершить обмен между<br />кошельками одной<br />валюты;</span></div>
                            </li>
                            <li>
                                <div class="ah-img">
                                    <img src="img/icon/icon-change-02.png" /></div>
                                <div class="ah-text"><span>обменять одну<br />электронную валюту<br />на другую;</span></div>
                            </li>
                            <li>
                                <div class="ah-img">
                                    <img src="img/icon/icon-change-03.png" /></div>
                                <div class="ah-text"><span>перевести электронные<br />деньги на карту любого<br />из банков;</span></div>
                            </li>
                            <li>
                                <div class="ah-img">
                                    <img src="img/icon/icon-change-04.png" /></div>
                                <div class="ah-text"><span>пополнить баланс<br />кошелька с карты.</span></div>
                            </li>
                        </ul>
                    </div>
            </div>
            </section>
			<div id="comment_dialog" class="ah-popup js-popup-comment ah-hidden">
				<div class="ah-popup-bg"></div>
				<div class="ah-popup-content">
					<div class="ah-panel ah-panel-green2 ah-bg-nah">
						<div class="ah-header">
							<h4>ОСТАВИТЬ ОТЗЫВ</h4>
						</div>
						<div class="ah-content">
							<form action="<?=Url::to(['site/testimonial'])?>" method="post" class="ajax-form">
								<div class="ah-form-field">
									<p>Ваше фото</p>
									<div class="btadd">
										<button class="ah-button ah-button-orange">Выберите файл</button>
										<input type="file" name="avatar" id="avatar">
									</div>
								</div>
								<div class="ah-form-field">
									<input required type="text" placeholder="Как Вас зовут" name="name" />
								</div>
								<div class="ah-form-field">
									<input required type="text" placeholder="Email" name="email" />
								</div>
								<div class="ah-form-field">
									<textarea placeholder="Ваш отзыв" name="content"></textarea>
								</div>
								<input required type="hidden" name="enabled" value="1">
								<input required type="hidden" name="date" value="<?=date('Y-m-d')?>">
								<div class="ah-form-submit">
									<input required type="submit" value="ОТПРАВИТЬ" class="ah-button ah-button-orange"/>
								</div>
							</form>
							<div class="ah-button-close js-popup-close"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="tot_dialog" class="ah-popup js-popup-total ah-hidden">
				<div class="ah-popup-bg"></div>
				<div class="ah-popup-content">
					<div class="ah-panel ah-panel-green2 ah-bg-nah">
						<div class="ah-header">
							<h4>ПОДТВЕРДИТЕ ОБМЕН</h4>
						</div>
						<div class="ah-content">
							<form action="">
								<div id="voucher" class="ah-hidden ah-form-field"><input type="text" id="voucher_input" name="voucher_code" placeholder="" required></div>
								<div id="total"></div>
							</form>							
						</div>
						<div id="closeTotDialog" class="ah-button-close js-popup-close"></div>
					</div>
				</div>
				<!--<form action="">
					<h5>Подтвердите обмен</h5>
					<div id="voucher" class="hidden"><input type="text" id="voucher_input" name="voucher_code" placeholder="" required></div>
					<div id="total"></div>
				</form>-->
			</div>			
			<div id="success_modal" class="ah-popup js-popup-success ah-hidden">
				<div class="ah-popup-bg"></div>
				<div class="ah-popup-content">
					<div class="ah-panel ah-panel-green2 ah-bg-nah">
						<div class="ah-header">
							<h5>Ваша заявка принята в обработку</h5>
						</div>
					</div>
				</div>					
			</div>
        </main>
