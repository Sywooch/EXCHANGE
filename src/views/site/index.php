<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="bid">
    <div class="container">
        <div class="bid-block">
            <div class="info-wrapper">
                <div class="info">
                    <div class="mob-info">
                        <div class="capt">1 USD = 62.35 RUR, 1 BTC = 614.846 USD, 1 LTC = 3.8435 USD, 1 ETH = 12.51 USD</div>
                        <label>У вас есть</label>
                        <select>
                            <?php foreach($currency as $item): ?>
                            <option data-image="<?=$item->getImage()?$item->getImage()->getUrl('15x'):''?>"><?=$item->title?></option>
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
                            <?php foreach($currency as $k => $item): ?>
                            <div class="row value <?=!$k ? 'active' : ''?>" data-id-caption="<?=$item->id?>">
                                <div class="image"><div><?=$item->getImage() ? Html::img($item->getImage()->getUrl()) : ''?></div></div>
                                <div class="amount">1.0000 <?=$item->title?> <?=$item->type?></div>
                                <div class="clearfix"></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php foreach($currency as $k => $item): ?>
                    <div class="col-2 <?=$k ? 'hidden': ''?>" data-id="<?=$item->id?>">
                        <div class="head">Вы можете получить</div>
                        <div class="rows">
                            <?php foreach($item->directions as $direction){ ?>
                            <div class="row" data-child-id="<?=$direction->to->id?>" data-course="<?=$direction->course?>">
                                <div class="image"><div><?=$direction->to->getImage() ? Html::img($direction->to->getImage()->getUrl()) : ''?></div></div>
                                <div class="amount"><?=$direction->course?> <?=$direction->to->title?> <?=$direction->to->type?></div>
                                <div class="clearfix"></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                        <div class="col-3 <?=$k ? 'hidden': ''?>" data-id="<?=$item->id?>">
                            <div class="head">Получаете Резерв</div>
                            <div class="rows">
                                <?php foreach($item->directions as $direction){ ?>
                                <div class="row">
                                    <div class="reserve"><?=$direction->to->reserve.' '.$direction->to->type?></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                                <option value="<?=$item->id?>" data-image="<?=$item->getImage()?$item->getImage()->getUrl('15x'):''?>"><?=$item->title?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="amount">
                            <input type="text" name="from_value" id="from_value_input" placeholder="min 500" />
                            <div class="currency">RUR</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <select id="cur_to" name="exchange_to_id">
                            <?php foreach($currency_all as $item): ?>
                                <option value="<?=$item->id?>" data-image="<?=$item->getImage()?$item->getImage()->getUrl('15x'):''?>"><?=$item->title?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="amount">
                            <input type="text" name="to_value" id="to_value_input" placeholder="0" />
                            <div class="currency">RUR</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="hint">По курсу: <span id="form_course"></span> RUR Visa/MasterCard RUB = 1 RUR Яндекс.Деньги</div>
                    <div class="row">
                        <input type="text" name="card" placeholder="Номер карты" class="full" />
                    </div>
                    <div class="row">
                        <input type="text" name="bank" placeholder="Название банка" class="full" />
                    </div>
                    <div class="row">
                        <input type="text" name="fio" placeholder="ФИО отправителя" class="full" />
                    </div>
                    <div class="row">
                        <input type="text" name="wallet" placeholder="Кошелек для получения" class="full" />
                    </div>
                    <div class="row">
                        <input type="text" name="email" placeholder="Ваш Email" class="full" />
                    </div>
                    <div class="agree">
                        <input type="checkbox" id="ch" /> <label for="ch">Я согласен с правилами обмена</label>
                    </div>
                    <div class="control">
                        <button>Перейти к оплате</button>
                    </div>
                </div>
            </form><!-- /.form -->
            <div class="clearfix"></div>
        </div>
        <div class="link">
            <a href="#">&nbsp;</a>
        </div>
    </div>
</div>
