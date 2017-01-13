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

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="icon" href="/favicon.png">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="header">
        <div class="mob-control">
            <button>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="top">
            <div class="container">
                <div class="logo">
                    <a href="/"><img src="/img/logo.png" alt=""></a>
                </div>
                <div class="links">
                    <div class="two-cols">
                        <div class="email">
                            <span><a href="#"><?=$email?></a></span>
                        </div>
                        <div class="icq"><span><?=$icq?></span></div>
                        <div class="jabber">
                            <span><a href="#"><?=$jabber?></a></span>
                        </div>
                        <div class="email phone">
                            <span><a href="#"><?=$phone?></a></span>
                        </div>
                    </div>
                    <div class="l-clearfix"></div>
                    <div class="rl-block">
                        <?php if(!Yii::$app->user->isGuest): ?>
                        <div>
                            <div class="login">
                                <a href="<?=Url::to(['/account/index'])?>"><div>Личный кабинет</div><div>
                                  [<?=Yii::$app->user->identity->username?>]</div></a>
                            </div>
                            <div class="reg logout">
                                <a href="<?=Url::to(['/site/logout'])?>"  data-method="post">Выйти</a>
                            </div>
                        </div>
                        <?php else: ?>
                            <div>
                                <div class="login">
                                    <a href="#" id="auth_dialog_btn">Войти</a>
                                </div>
                                <div class="reg">
                                    <a href="#" id="reg_dialog_btn">Регистрация</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.top -->
        <div class="menu">
            <div class="container">
                <div class="close"></div>
                <ul class="nav">
                    <li><a href="/">Обмен валют</a></li>
                    <li><a href="<?=Url::to(['page/index', 'slug'=>'pravila'])?>">Правила</a></li>
                    <li><a href="<?=Url::to(['page/help'])?>">Помощь</a></li>
                    <li><a href="<?=Url::to(['page/index', 'slug'=>'partneram'])?>">Партнерам</a></li>
                    <li><a href="<?=Url::to(['news/index'])?>">Новости</a></li>
                    <li><a href="<?=Url::to(['page/index', 'slug'=>'kontakty'])?>">Контакты</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.menu -->
    </div><!-- /.header -->
    <?=$content?>

<div class="footer">
    <div class="container">
        <div class="info">
            <div class="copy">© 100 монет 2014—2016. Все права защищены</div>
            <div>Экспорт курсов в xml: xrates.ru, bestchange.ru</div>
            <div>Добавление вашего IP по запросу</div>
        </div>
        <div class="counters">
            <div class="counter"><img src="/img/counter-1.jpg" /></div>
            <div class="counter"><img src="/img/counter-2.jpg" /></div>
            <div class="counter"><img src="/img/counter-3.jpg" /></div>
            <div class="counter"><img src="/img/counter-4.jpg" /></div>
            <div class="counter"><img src="/img/counter-5.jpg" /></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div><!-- /.footer -->

<div id="reg_dialog">
    <div class="d-title">Регистрация</div>
	<?php
    $user = Yii::createObject(RegistrationForm::className());
    $form = ActiveForm::begin([
            'id' => 'registration-form',
            'options'=>[
                'class'=>'ajax-form',
            ],
            'action' => ['/user/register'],
	]); ?>
	    <?= $form->field($user, 'email')->textInput(['placeholder'=>'Email'])->label(false) ?>
	    <?= $form->field($user, 'username')->hiddenInput()->label(false) ?>
        <?= $form->field($user, 'password')->passwordInput(['placeholder'=>'Пароль'])->label(false) ?>
	    <?= $form->field($user, 'source')->hiddenInput()->label(false) ?>
        <div class="chkbx">
            <input type="checkbox" id="acc" /> <label for="acc">Я принимаю <a href="#">условия соглашения</a> </label>
            <div class="clearfix"></div>
        </div>
        <div class="chkbx">
            <input type="checkbox" id="all" /> <label for="all">Разрешаю обработку моих персональных данных</label>
            <div class="clearfix"></div>
        </div>
	    <?= Html::submitInput('Зарегистрироваться') ?>
	<?php ActiveForm::end(); ?>
</div>

<div id="alertModal">
    <div class="d-title">Ошибка</div>

    <div class="cont"></div>
</div>

<div id="reset_dialog">
    <div class="d-title">Восстановление</div>
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
    ]);
    echo $form->field($reset, 'email')->textInput(['placeholder'=>'Email'])->label(false);
    echo Html::submitInput('Отправить');
    ActiveForm::end(); ?>
</div>

<div id="auth_dialog">
    <div class="d-title">Авторизация</div>
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

	<?= $form->field($login,'login')->textInput(['placeholder'=>'Email'])->label(false) ?>

	<?= $form->field($login,'password')->passwordInput(['placeholder'=>"Пароль"])->label(false) ?>

    <div class="chkbx">
	<?= $form->field($login, 'rememberMe')->checkbox([],false)->label('Запомнить меня') ?>
        <div class="forgot"><a id="reset_dialog_btn" href="#">Забыли пароль?</a></div>
        <div class="clearfix"></div>
    </div>
	<?= Html::submitInput('Войти') ?>

	<?php ActiveForm::end(); ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
