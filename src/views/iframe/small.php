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

		<div class="form-1 iframe-form" ng-app="ExchangeApp" ng-controller="FormController">
			<div class="form-wrapper">
				<div class="f-title">Пожалуйста выберите направление обмена</div>
				<div class="image"><img src="/img/ref-link.jpg" /></div>
				<form>
					<label>Получаете</label>
					<select id="cur_from">
						<option value="{{currency.id}}" ng-repeat="currency in currencies" data-image="{{currency.ajaxIcon}}">{{currency.title}} {{currency.type}}</option>
					</select>
					<label>Отдаете</label>
					<select id="cur_to">
                        <option ng-repeat="curr in directions | filter:{'currency_from': activeCurrency.id}:true" value="{{curr.currency_to}}" data-image="{{curr.ajaxIcon}}">{{curr.currencyTitle}}</option>
					</select>
					<div class="course"><p>Курс обмена:</p> 1 {{directionActive.from.title}} => {{directionActive.course}} {{directionActive.to.title}}</div>
					<a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['site/index'])?>" class="tosite">Продолжить</a>
				</form>
			</div>
		</div>
