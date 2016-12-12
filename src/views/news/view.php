<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 7:07
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
?>

<div class="article-page">
	<div class="container">
		<h1><?=$this->title?> <div><?=Yii::$app->formatter->asDate($model->date, 'php:d.m.Y'); ?></div></h1>

		<div class="main-content">
			<div class="full-new">
				<div class="image"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('417x240')) : ''?></div>
				<?=Html::decode($model->content)?>
			</div>
		</div>
		<div class="right-content">
			<div class="r-title">Популярные статьи</div>
			<div class="popular">
              <?php foreach($popular as $model): ?>
                  <div class="item">
                      <div class="image">
												<?=$model->getImage() ? Html::img($model->getImage()->getUrl('136x75')) : ''?>
                      </div>
                      <div class="name"><a href="<?=Url::to(['article/view', 'slug'=>$model->slug])?>"><?=$model->title?></a></div>
                      <div class="clearfix"></div>
                  </div>
              <?php endforeach; ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div><!-- /.article-page -->