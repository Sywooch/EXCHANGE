<?php
use app\assets\AppAsset;
use app\models\Credential;
use app\models\Currency;
use app\models\User;
use app\models\RegistrationForm;
use app\models\UserWallet;
use dektrium\user\models\LoginForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$user_fields=Yii::$app->user->identity->getWallets()->all() ? ArrayHelper::map(Yii::$app->user->identity->getWallets()->all(), 'field_id', 'wallet', 'currency_id') : [];

$email = Credential::findOne(['slug'=>'email'])->value;
$jabber = Credential::findOne(['slug'=>'jabber'])->value;
$phone = Credential::findOne(['slug'=>'phone'])->value;
$icq = Credential::findOne(['slug'=>'icq'])->value;

/*
 * <?=!empty($user_fields[$field->id]) ? $user_fields['id'] : $user_fields['id']?>
 * */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="ah-main-wrapper page">
        <header>
            <div class="ah-wrapper">
                <div class="ah-header">
                    <div class="ah-logo">
                        <a href="<?=Url::Home();?>">
                            <img src="/img/logo.png" />
                        </a>
                    </div>
                    <div class="ah-mail">
                        <a href="mailto:<?=$email?>"><?=$email?></a>
                        <a href="mailto:<?=$jabber?>"><?=$jabber?></a>
                    </div>
                    <div class="ah-call">
                        <span class="ah-icq"><?=$icq?></span>
                        <span class="ah-tel"><?=$phone?></span>
                    </div>
                    <div class="ah-auth">
                        <?php if(!Yii::$app->user->isGuest): ?>                        
                            <a class="ah-login" href="<?=Url::to(['/account/index'])?>">Личный кабинет<br>[<?=Yii::$app->user->identity->username?>]</a>
                            <a class="ah-register" href="<?=Url::to(['/site/logout'])?>">Выйти</a>
                        <?php else: ?>
                            <a class="ah-login js-button-auth" href="javascript:void(0)">Вход на сайт</a>
                            <a class="ah-register js-button-register" href="javascript:void(0)">Регистрация</a>
                        <?php endif; ?>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li class="ah-active"><a href="/">ОБМЕН ВАЛЮТ</a></li>
                        <li><a href="<?=Url::to(['page/index', 'slug'=>'pravila'])?>">ПРАВИЛА</a></li>
                        <?php /* <li><a href="<?=Url::to(['page/help'])?>">ПОМОЩЬ</a></li> */ ?>
                        <li><a href="<?=Url::to(['page/index', 'slug'=>'partneram'])?>">ПАРТНЕРАМ</a></li>
                        <li><a href="<?=Url::to(['news/index'])?>">НОВОСТИ</a></li>
                        <li><a href="<?=Url::to(['page/index', 'slug'=>'kontakty'])?>">КОНТАКТЫ</a></li>
                    </ul>
                </nav>
                <button type="button" class="main-nav-button"></button>
            </div>
        </header>
        <?=$this->render('/account/_menu')?>
        <?=$content?>
        
        <?php if(!empty($this->params['showFirms'])):
            $currencies = Currency::find()->all();
            $i = 1;
        ?>
        <?php $form = ActiveForm::begin([
                    'id'=>'firms-form',
              'options'=>['class'=>'firms'],
            ])?>
        <div class="currencies-list">					
		<?foreach($currencies as $currency):
            //var_dump($currency->fields);
            ?>
			<?php if($i == 1){?>
			<div class="ah-group">
			<?php } ?>
				<div class="item payway">
					<div class="ah-img"><?=$currency->getImage() ? Html::img($currency->getImage()->getUrl()) : ''?></div>
					<div class="ah-name"><?=$currency->title?></div>
				</div>
                <div class="ah-popup form-group ah-hidden">
                    <div class="ah-popup-bg"></div>
                    <div class="ah-popup-content">
                        <div class="ah-panel ah-panel-green2 ah-bg-nah">
                            <div class="ah-header">
                                <h4>СОЗДАТЬ ШАБЛОН АВТОЗАПОЛНЕНИЯ</h4>
                            </div>
                            <div class="ah-content">
                                <?php foreach($currency->fields as $field): ?>
                                <div class="ah-form-field">
                                    <input type="text" placeholder="<?=$field->title?>" name="currency[<?=$field->currency_id?>][fields][<?=$field->id?>]" <?php if($user_fields){?>value="<?=!empty($user_fields[$field->currency_id][$field->id]) ? $user_fields[$field->currency_id][$field->id] : ''?>" <?php } ?>>
                                </div>
                                <?php endforeach; ?>
                                <div class="ah-form-submit">
                                <?=Html::submitButton('СОХРАНИТЬ', ['class'=>'btn-save-firm ah-button ah-button-orange'])?>
                                </div>
                                <div class="ah-button-close js-popup-close"></div>
                            </div>
                        </div>
                    </div>
                </div>                
			<?php if($i == 3){ $i = 0;?>
			</div>
			<?php }?>
		<?$i++;endforeach;?>
		</div>
        <?php ActiveForm::end()?><!-- /.firms -->
        <? endif; ?>
        
        
        
        
        <footer>
            <div class="ah-wrapper">
                <p class="ah-text-center">Сотрудничая с нами, вы получаете не только уверенность в честности проводимой сделки, но и значительно экономите на совершении переводов.</p>
                <div class="ah-copy">
                    <p>Copyright 2017 Web-obmen</p>
                </div>
                <nav class="ah-footer-nav">
                    <ul>
                        <li class="ah-active"><a href="/">ОБМЕН ВАЛЮТ</a></li>
                        <li><a href="<?=Url::to(['page/index', 'slug'=>'pravila'])?>">ПРАВИЛА</a></li>
                        <?php /* <li><a href="<?=Url::to(['page/help'])?>">ПОМОЩЬ</a></li> */ ?>
                        <li><a href="<?=Url::to(['page/index', 'slug'=>'partneram'])?>">ПАРТНЕРАМ</a></li>
                        <li><a href="<?=Url::to(['news/index'])?>">НОВОСТИ</a></li>
                        <li><a href="<?=Url::to(['page/index', 'slug'=>'kontakty'])?>">КОНТАКТЫ</a></li>
                    </ul>
                </nav>
                <div class="ah-social">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="/img/icon/icon-fb.png" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/img/icon/icon-tw.png" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/img/icon/icon-ma.png" />
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="/img/icon/icon-gp.png" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>