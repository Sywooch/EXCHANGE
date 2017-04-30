<?php
use app\assets\AppAsset;
use app\models\Credential;
use app\models\Settings;
use app\models\User;
use app\models\RegistrationForm;
use dektrium\user\models\LoginForm;
use dektrium\user\models\RecoveryForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$email = Credential::findOne(['slug'=>'email'])->value;
$jabber = Credential::findOne(['slug'=>'jabber'])->value;
$phone = Credential::findOne(['slug'=>'phone'])->value;
$icq = Credential::findOne(['slug'=>'icq'])->value;
//$page = ((Url::current() == '/site/index' || Url::current() == '/site/error') ? 'main' : 'page');
//$page = (Url::current() == '/news' ? 'page' : 'main');
$pageClass = ((Url::current() != '/site/index' && Url::current() != '/site/error' && Url::current() != '/news/index') ? 'page' : '');
$pageOrMain = ((Url::current() == '/page/partneram') ? 'page' : 'main');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="icon" href="/favicon.png">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="ah-<?=$pageOrMain?>-wrapper <?=$pageClass?>">
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
                            <a class="ah-login" href="<?=Url::to(['/account/index'])?>">Личный кабинет<span>[<?=Yii::$app->user->identity->username?>]</span></a>
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
                <? if($pageOrMain == 'page'):?>
                <button class="ah-button ah-button-orange js-button-register">ЗАРЕГИСТИРОВАТЬСЯ</button>
                <? endif;?>
            </div>
        </header>
        <?=$content?>
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
    <div id="alertModal" class="ah-popup js-popup-alert ah-hidden">
        <div class="ah-popup-bg"></div>
        <div class="ah-popup-content">
            <div class="ah-panel ah-panel-green2 ah-bg-nah">
                <div class="ah-header">
                    <h4>ОШИБКА</h4>
                </div>
                <div class="ah-content cont">
                    
                </div>
                <div class="ah-button-close js-popup-close"></div>
            </div>
        </div>
    </div>
    <div class="ah-popup js-popup-ask ah-hidden">
        <div class="ah-popup-bg"></div>
        <div class="ah-popup-content">
            <div class="ah-panel ah-panel-green2 ah-bg-nah">
                <div class="ah-header">
                    <h4>ОТПРАВЬТЕ НАМ СООБЩЕНИЕ</h4>
                </div>
                <div class="ah-content">
                    <form>
                        <div class="ah-form-field">
                            <input placeholder="Ваше имя" type="text" />
                        </div>
                        <div class="ah-form-field">
                            <input placeholder="Ваш телефон" type="tel" />
                        </div>
                        <div class="ah-form-field">
                            <input placeholder="Ваш Email*" type="email" />
                        </div>
                        <div class="ah-form-field">
                            <textarea placeholder="Ваше сообщение*"></textarea>
                        </div>
                        <div class="ah-form-submit">
                            <input type="submit" class="ah-button ah-button-orange" value="ОТПРАВИТЬ" />
                        </div>
                    </form>
                </div>
                <div class="ah-button-close js-popup-close"></div>
            </div>
        </div>
    </div>
    <div id="auth_dialog" class="ah-popup js-popup-auth ah-hidden">
        <div class="ah-popup-bg"></div>
        <div class="ah-popup-content">
            <div class="ah-panel ah-panel-blue ah-bg-nah">
                <div class="ah-header">
                    <h4>АВТОРИЗАЦИЯ</h4>
                </div>
                <div class="ah-content">
                    <?php
                        $login = \Yii::createObject(LoginForm::className());
                        $form = ActiveForm::begin([
                                'id'                     => 'login-form',
                                'enableAjaxValidation'   => true,
                                'enableClientValidation' => false,
                                'validateOnBlur'         => false,
                                'validateOnType'         => false,
                                'validateOnChange'       => false,
                          'options'=>['class'=>'ajax-form'],
                          'action'=>['/user/login']
                        ]) ?>
                    
                        <div class="ah-form-field">
                            <?= $form->field($login,'login')->textInput(['placeholder'=>'Ваш Email'])->label(false) ?>
                        </div>
                        <div class="ah-form-field">
                            <?= $form->field($login,'password')->passwordInput(['placeholder'=>"Пароль"])->label(false) ?>
                        </div>
                        <div class="ah-row ah-space_between">
                            <div class="ah-form-check">
                                <?//= $form->field($login, 'rememberMe')->checkbox([],false)->label('Запомнить меня') ?>
                                <!--<label for="rememberMe">Запомнить меня</label>-->
                                <input type="checkbox" id="login-form-rememberme" name="login-form[rememberMe]" value="0">
                                <label class="control-label" for="login-form-rememberme">Запомнить меня</label>
                            </div>
                            <div>
                                <a id="reset_dialog_btn" class="js-button-reset" href="#">Забыли пароль?</a>
                            </div>
                        </div>
                        <div class="ah-form-submit">
                            <?= Html::submitInput('ВОЙТИ', ['class' => 'ah-button ah-button-orange']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <div class="ah-button-close js-popup-close"></div>
                </div>
                
            </div>
        </div>
    </div>
    <div id="reset_dialog" class="ah-popup js-popup-reset ah-hidden">
        <div class="ah-popup-bg"></div>
        <div class="ah-popup-content">
            <div class="ah-panel ah-panel-blue ah-bg-nah">
                <div class="ah-header">
                    <h4>ВОССТАНОВЛЕНИЕ</h4>
                </div>
                <div class="ah-content">
                    <?php
                    $reset = \Yii::createObject([
                            'class'    => RecoveryForm::className(),
                            'scenario' => RecoveryForm::SCENARIO_REQUEST,
                    ]);
                    $form = ActiveForm::begin([
                        'action'=>Url::to(['/user/recovery/request']),
                        'id'                     => 'password-recovery-form',
                        'enableAjaxValidation'   => true,
                        'enableClientValidation' => false,
                        'options'=>[
                          /*'class'=>'ajax-form'*/
                        ]
                    ]);?>
                    <div class="ah-form-field">                        
                         <?= $form->field($reset, 'email')->textInput(['placeholder'=>'Email'])->label(false); ?>
                    </div>
                    <div class="ah-form-submit">
                        <?= Html::submitInput('ОТПРАВИТЬ', ['class' => 'ah-button ah-button-orange']); ?>
                    </div>                    
                    <?php ActiveForm::end(); ?>
                    <div class="ah-button-close js-popup-close"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="reg_dialog" class="ah-popup js-popup-register ah-hidden">
        <div class="ah-popup-bg"></div>
        <div class="ah-popup-content">
            <div class="ah-panel ah-panel-green2 ah-bg-nah">
                <div class="ah-header">
                    <h4>РЕГИСТРАЦИЯ</h4>
                </div>
                <div class="ah-content">
                    <?php
                    $user = Yii::createObject(RegistrationForm::className());
                    $form = ActiveForm::begin([
                            'id' => 'registration-form',
                            'options'=>[
                                'class'=>'ajax-form',
                            ],
                            'action' => ['/user/register'],
                    ]); ?>
                    <div class="ah-form-field">
                        <?= $form->field($user, 'email')->textInput(['placeholder'=>'Ваш Email'])->label(false) ?>
                        <?= $form->field($user, 'username')->hiddenInput()->label(false) ?>
                    </div>
                    <div class="ah-form-field">
                        <?= $form->field($user, 'password')->passwordInput(['placeholder'=>'Пароль'])->label(false) ?>
                        <?= $form->field($user, 'source')->hiddenInput()->label(false) ?>
                    </div>
                    <div class="ah-form-field">
                        <div class="ah-form-check">
                            <input type="checkbox" id="accept" />
                            <label for="accept">Я принимаю&nbsp;<a href="#">условия соглашения</a></label>
                        </div>
                    </div>
                    <div class="ah-form-field">
                        <div class="ah-form-check">
                            <input type="checkbox" id="aprove" />
                            <label for="aprove">Разрешаю обработку моих персональных данных</label>
                        </div>
                    </div>
                    <div class="ah-form-submit">
                        <?= Html::submitInput('ЗАРЕГЕСТРИРОВАТЬСЯ', ['class' => 'ah-button ah-button-orange']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="ah-button-close js-popup-close"></div>
            </div>
        </div>
    </div>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = 'xpm6Eojhs5';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id;
        var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
        if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-587a7e67ade82ba8"></script>-->   
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>