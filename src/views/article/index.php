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
$this->title = 'Блог';
?>

<div class="article-page">
	<div class="container">
		<h1><span>Н</span>овости</h1>

		<div class="main-content">
			<div class="news-list">
                <div class="big-new">
                    <div class="info">
                        <div class="image">
                            <?=$main[0]->getImage() ? Html::img($main[0]->getImage()->getUrl('383x264')) : ""?>
                        </div>
                        <div class="name">
                            <a href="<?=Url::to(['article/view', 'slug'=>$main[0]->slug])?>"><?=$main[0]->title?></a>
                        </div>
                        <div class="date"><?=Yii::$app->formatter->asDate($main[0]->date, 'php:d.m.Y'); ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="list">
                        <?php array_shift($main); foreach($main as $model): ?>
                        <div class="item">
                            <div class="image">
                                <?=$model->getImage() ? Html::img($model->getImage()->getUrl('136x75')) : ''?>
                            </div>
                            <div class="data">
                                <div class="name"><a href="<?=Url::to(['article/view', 'slug'=>$model->slug])?>"><?=$model->title?></a></div>
                                <div class="text"><?=StringHelper::truncateWords(strip_tags($model->content), 10)?></div>
                                <div class="date"><?=Yii::$app->formatter->asDate($model->date, 'php:d.m.Y'); ?></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
				<?php foreach($models as $model): ?>
				<div class="new-item">
					<div class="image"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('254x196')) : ''?></div>
					<div class="info">
						<div class="name"><a href="<?=Url::to(['article/view', 'slug'=>$model->slug])?>"><?=$model->title?></a></div>
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
