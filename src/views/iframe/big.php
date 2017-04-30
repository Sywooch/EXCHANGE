<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 16.12.16
 * Time: 17:47
 */

use app\assets\NgAppAsset;

NgAppAsset::register($this);
?>

<div class="form-2 iframe-form" ng-app="ExchangeApp" ng-controller="FormController">
    <div class="form-wrapper">
        <div class="ah-panel ah-panel-green">
            <div class="ah-header">
                <h4>ПОЖАЛУЙСТА ВЫБЕРИТЕ НАПРАВЛЕНИЕ ОБМЕНА</h4>
            </div>
            <div class="ah-content">
                <div class="ah-img"><img src="/img/ref-link.jpg" /></div>
                <form>
                    <div class="ah-form-select">
                        <div id="cur_to" class="ps-select">
                            <div class="ps-content">Получаете</div>
                            <div class="ps-arrow"></div>
                            <div class="ps-list">
                                <div>Получаете</div>
                                <div ng-repeat="direction in filteredDirections = (directions | filter:{'currency_from': activeCurrency.id}:true)" ng-class="{active:directionActive.id == direction.id}" ng-click="changeDirection(direction)">
                                    <i class="ah-icon ah-icon-02" style="background-image:url({{direction.ajaxIcon}});"></i>
                                    <span>{{direction.currencyTitle}} {{direction.currencyType}}</span>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="ah-form-select">
                        <div id="cur_from" class="ps-select" style="z-index: 99;">
                            <div class="ps-content">Отдаете</div>
                            <div class="ps-arrow"></div>
                            <div class="ps-list">
                                <div>Отдаете</div>
                                <div ng-repeat="item in currencies" class="row value" ng-class="{active: activeCurrency.id == item.id}" ng-click="changeCurrency(item)">
                                    <i class="ah-icon ah-icon-01" style="background-image:url({{item.ajaxIcon}});"></i>
                                    <span>{{item.title}} {{item.type}}</span>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="course"><p>Курс обмена: 1 => {{directionActive.course}}</p></div>
                    <div class="ah-form-submit">
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['site/index'])?>" class="tosite"><button type="button" class="ah-button ah-button-orange">Продолжить</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>