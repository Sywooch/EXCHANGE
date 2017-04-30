<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 13.12.16
 * Time: 3:59
 */
$this->title = 'Личный кабинет';
?>

<div class="lk-main">
	<div class="exchange">
        <div class="form-1">
            <iframe src="<?=Yii::$app->urlManager->createAbsoluteUrl(['iframe/view', 'type'=>'small'])?>" frameborder="0" width="249" height="344"></iframe>
            <div class="link">
				<textarea id="text-1"><iframe src="<?=Yii::$app->urlManager->createAbsoluteUrl(['iframe/view', 'type'=>'small'])?>" frameborder="0" width="249" height="344"></iframe></textarea>
            </div>
            <div class="copy" data-clipboard-target="#text-1">Скопировать в буфер</div>
        </div>
		<div class="form-2">
            <iframe src="<?=Yii::$app->urlManager->createAbsoluteUrl(['iframe/view', 'type'=>'big'])?>" frameborder="0" width="330" height="320"></iframe>
            <div class="link">
				<textarea id="text-2"><iframe src="<?=Yii::$app->urlManager->createAbsoluteUrl(['iframe/view', 'type'=>'big'])?>" frameborder="0" width="330" height="320"></iframe></textarea>
            </div>
            <div class="copy" data-clipboard-target="#text-2">Скопировать в буфер</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

            </div>
		</section>
    </div>
</main>