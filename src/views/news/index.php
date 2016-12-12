<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 7:07
 */
use app\components\Formatter;
use app\widgets\CustomPager;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->title = 'Новости';
?>

<div class="article-page">
	<div class="container">
		<h1><span>Н</span>овости</h1>

		<div class="main-content">
			<div class="news-list">
				<?php foreach($models as $model): ?>
				<div class="new-item">
					<div class="image"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('254x196')) : ''?></div>
					<div class="info">
						<div class="name"><a href="<?=Url::to(['news/view', 'slug'=>$model->slug])?>"><?=$model->title?></a></div>
						<div class="date"><?=Yii::$app->formatter->asDate($model->date, 'php:d.m.Y'); ?></div>
						<div class="clearfix"></div>
						<div class="text"><?=StringHelper::truncateWords(strip_tags($model->content), 80)?></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="pagination-wrapper">
              <?php echo CustomPager::widget(['pagination' => $pages]); ?>
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
