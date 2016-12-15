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
          $sizes = $this->context->ranger('http://'.$_SERVER['SERVER_NAME'].$banner->getImage()->getUrl());
        var_dump($sizes);
          ?>
		<div class="type" data-banner="<?=$banner->id?>"><?=$sizes[0]?>x<?=$sizes[1]?></div>
		<?php endforeach; ?>
        <div class="clearfix"></div>
	</div>

	<?php foreach($banners as $banner): ?>
		<div class="ref-link">
        <?=Html::decode($banner->code)?>
        <div class="ref-container">
                            <textarea>
            <?=$banner->code?>
                            </textarea>
        </div>
        <div class="copy">Скопировать в буфер</div>
    </div>
	<?php endforeach; ?>

</div>
