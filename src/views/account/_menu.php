<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 3:50
 */
use yii\helpers\Url;

?>
<main class="personal-cab">
	<div class="ah-wrapper page">
		<div class="ah-breadcrumbs">
			<ul>
				<li><a href="<?=Url::home()?>">главная</a></li>
				<li><?=$this->title?></li>
			</ul>
		</div>
		<section class="ah-personal">
            <div class="ah-content">
                <h1>Личный кабинет</h1>
                <div class="ah-lk-menu">
                    <a class="item<?php echo (Url::current() == '/account/index' ? ' active' : '');?>" href="<?=Url::to(['account/index'])?>">заявки</a>
                    <a class="item<?php echo (Url::current() == '/account/security' || Url::current() == '/account/autofill' ? ' active' : '');?>" href="<?=Url::to(['account/security'])?>">настройки</a>
                    <a class="item<?php echo (Url::current() == '/account/referer' ? ' active' : '');?>" href="<?=Url::to(['account/referer'])?>">реферальная программа</a>
                    <a class="item<?php echo (Url::current() == '/account/materials' ? ' active' : '');?>" href="<?=Url::to(['account/materials'])?>">рекламные материалы</a>
                    <a class="item<?php echo (Url::current() == '/account/forms' ? ' active' : '');?>" href="<?=Url::to(['account/forms'])?>">формы обмена</a>
                        <!--<div class="line line-1"></div>
                        <div class="line line-2"></div>
                        <div class="line line-3"></div>
                        <div class="line line-4"></div>
                        <div class="clearfix"></div>-->
                </div>
