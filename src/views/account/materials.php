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
	<div class="ah-top-text">Ваша реферальная ссылка для приглашения других пользователей:  <a href="https://xchange.cc/?rid=14755865688186">https://xchange.cc/?rid=14755865688186</a></div>    
    <div class="types">
        <?php foreach($banners as $banner):
          //$sizes = [1,1];
          $sizes = $this->context->ranger('http://'.$_SERVER['SERVER_NAME'].$banner->getImage()->getUrl()); ?>
		<div class="type banner-type" data-banner="<?=$banner->id?>"><?=$sizes[0]?>x<?=$sizes[1]?></div>
		<?php endforeach; ?>
	</div>
    <div class="banners">
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
	<div class="currencies-list">
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-01.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-02.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-03.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-04.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-05.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-06.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-07.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-08.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-09.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
				<div class="ah-group">
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-10.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-11.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
					<div class="item">
						<div class="ah-img"><img src="../img/icon/icon-12.png"></div>
						<div class="ah-name">Название фирмы</div>
					</div>
				</div>
			</div>
</div>

            </div>
		</section>
    </div>
</main>