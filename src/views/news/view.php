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
<main>
	<div class="ah-wrapper page">
       <div class="ah-breadcrumbs">
           <ul>
               <li><a href="<?=Url::home()?>">главная</a></li>
			   <li><a href="<?=Url::to(['/news'])?>">новости</a></li>
               <li><?=$this->title?></li>
           </ul>
       </div>
       
       <section class="ah-partners news">
            <div class="ah-content">
				<h1><?=$this->title?></h1><p class="ah-date">21.07.2017<?//=Yii::$app->formatter->asDate($model->date, 'php:d.m.Y'); ?></p>
                <div class="ah-image"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('390x200')) : ''?></div>
				<?=Html::decode($model->content)?>
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
</main>