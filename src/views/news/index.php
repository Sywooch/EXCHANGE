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

<main>
    <div class="ah-wrapper page">
                <div class="ah-breadcrumbs">
                    <ul>
                        <li>
                            <a href="<?=Url::home()?>">
                                главная
                            </a>
                        </li>
                        <li>
                            новости
                        </li>
                    </ul>
                </div>
                <section class="ah-hews">
                    <div class="ah-content">
                        <h1>НОВОСТИ</h1>
                        <?php $i = 0; foreach($models as $model): ?>
                        <div class="ah-post <?php echo ($i & 1 ? '' : 'ah-blockquote'); ?>">
                            <div class="ah-img"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('160x91')) : ''?></div> <!--254x196-->
                            <div class="ah-text">
                                <div class="h2">
                                    <a href="<?=Url::to(['news/view', 'slug'=>$model->slug])?>"><h2><?=$model->title?></h2></a>
                                    <span><?//=Yii::$app->formatter->asDate($model->date, 'php:d.m.Y'); ?></span>
                                </div>
                                <p>
                                    <?=StringHelper::truncateWords(strip_tags($model->content), 80)?>
                                </p>
                            </div>
                        </div>
                        <?php $i++; endforeach; ?>                        
                        <div class="ah-pagination">
                            <?php echo CustomPager::widget(['pagination' => $pages]); ?>
                            <ul style="display: none;">
                                <li class="ah-prew">
                                    <a href="#">
                                        НАЗАД
                                    </a>
                                </li>
                                <li class="ah-active">
                                    <a href="#">
                                        1
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        2
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        3
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        4
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        5
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        6
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                       ...
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        16
                                    </a>
                                </li>
                                <li class="ah-next">
                                    <a href="#">
                                        ДАЛЕЕ
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <aside>
                        <div class="ah-panel ah-panel-green ah-popular">
                            <div class="ah-header">
                                <h4 class="ah-arrows">ПОПУЛЯРНЫЕ СТАТЬИ</h4>
                            </div>
                            <div class="ah-content">
                                <?php foreach($popular as $model): ?>
                                <div class="ah-row">
                                    <div class="ah-img"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('80x80')) : ''?></div>
                                    <div class="ah-text">
                                        <a href="<?=Url::to(['article/view', 'slug'=>$model->slug])?>"><p><?=$model->title?></p></a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </aside>
                </section>
            </div>
</main><!-- /.article-page -->
