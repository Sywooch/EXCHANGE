<?php
use app\assets\NgAppAsset;
use app\models\User;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model->title;
$aSideStyle = ($this->title != 'Партнерам' ? 'style="display: none;"' : '');
//echo $this->title;
$wrapperStyle = ($this->title == 'Партнерам' ? 'partners' : '');
?>
<main>
            <div class="ah-wrapper page <?=$wrapperStyle?>">
                <div class="ah-breadcrumbs">
                    <ul>
                        <li><a href="<?=Url::home()?>">главная</a></li>
                        <li><?=$this->title?></li>
                    </ul>
                </div>
                <section class="ah-partners">
                    <div class="ah-content">
                        <h1><?=$this->title?></h1>
                        <?=$model->content?>
                    </div>
                    <aside <?=$aSideStyle?>>
                        <div class="ah-panel ah-panel-green ah-reviews">
                            <div class="ah-header">
                                <h4 class="ah-arrows">ОТЗЫВЫ</h4>
                            </div>
                            <div class="ah-content">
                                <?php /*foreach($testimonials as $testimonial): ?>
                                <div class="ah-comment ah-row">
                                    <div class="ah-img"><?=$testimonial->getImage() ? Html::img($testimonial->getImage()->getUrl()) : ''?></div>
                                    <div class="ah-text">
                                        <p class="ah-name"><?=$testimonial->name?></p><span class="ah-date"><?=Yii::$app->formatter->asDate($testimonial->date); ?></span>
                                        <p><?=$testimonial->content?></p>
                                    </div>
                                </div>
								<?php endforeach; */?>
                            </div>
                            <div class="ah-footer">
                                <button class="ah-button-comment js-button-comment">ОСТАВИТЬ ОТЗЫВ</button>
                            </div>
                        </div>
                    </aside>
                </section>
            </div>
            <div id="comment_dialog" class="ah-popup js-popup-comment ah-hidden">
				<div class="ah-popup-bg"></div>
				<div class="ah-popup-content">
					<div class="ah-panel ah-panel-green2 ah-bg-nah">
						<div class="ah-header">
							<h4>ОСТАВИТЬ ОТЗЫВ</h4>
						</div>
						<div class="ah-content">
							<form action="<?=Url::to(['site/testimonial'])?>" method="post" class="ajax-form">
								<div class="ah-form-field">
									<p>Ваше фото</p>
									<div class="btadd">
										<button class="ah-button ah-button-orange">Выберите файл</button>
										<input type="file" name="avatar" id="avatar">
									</div>
								</div>
								<div class="ah-form-field">
									<input required type="text" placeholder="Как Вас зовут" name="name" />
								</div>
								<div class="ah-form-field">
									<input required type="text" placeholder="Email" name="email" />
								</div>
								<div class="ah-form-field">
									<textarea placeholder="Ваш отзыв" name="content"></textarea>
								</div>
								<input required type="hidden" name="enabled" value="1">
								<input required type="hidden" name="date" value="<?=date('Y-m-d')?>">
								<div class="ah-form-submit">
									<input required type="submit" value="ОТПРАВИТЬ" class="ah-button ah-button-orange"/>
								</div>
							</form>
							<div class="ah-button-close js-popup-close"></div>
						</div>
					</div>
				</div>
			</div>
        </main>