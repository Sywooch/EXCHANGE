<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 3:59
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Личный кабинет';
?>


<div class="lk-main">
	<div class="top-text">Ваша реферальная ссылка для приглашения других пользователей:  <a href="https://xchange.cc/?rid=14755865688186">https://xchange.cc/?rid=14755865688186</a></div>
	<div class="types">
        <?php foreach($banners as $banner):
          //$sizes = [1,1];
          $sizes = $this->context->ranger('http://'.$_SERVER['SERVER_NAME'].$banner->getImage()->getUrl()); ?>
		<div class="type banner-type" data-banner="<?=$banner->id?>"><?=$sizes[0]?>x<?=$sizes[1]?></div>
		<?php endforeach; ?>
        <div class="clearfix"></div>
	</div>

	<?php foreach($banners as $banner): ?>
		<div class="ref-link" data-banner-show="<?=$banner->id?>">
        <?=Html::decode($banner->code)?>
        <div class="ref-container">
                            <textarea id="text-<?=$banner->id?>">
            <?=str_replace('<USERID>', Yii::$app->user->id, $banner->code)?>
                            </textarea>
        </div>
        <div id="copy-button-<?=$banner->id?>" data-clipboard-target="#text-<?=$banner->id?>" class="copy">Скопировать в буфер</div>
    </div>
	<?php endforeach; ?>

</div>
