<?php
use app\assets\AppAsset;
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
                    <a href="/"><span>Web-</span>obmen.net</a>
                </div>
                <div class="links">
                    <div class="email">
                        <span><a href="#">stomonet.net@gmail.com</a></span>
                    </div>
                    <div class="icq"><span>ICQ -------</span></div>
                    <div class="jabber">
                        <span><a href="#">r0und.h0und@jabber.ru</a></span>
                    </div>
                    <div class="l-clearfix"></div>
                    <div class="rl-block">
                        <?php if(!Yii::$app->user->isGuest): ?>
                        <div>
                            <div class="login">
                                <a href="<?=Url::to(['account/index'])?>">Личный кабинет</a>
                            </div>
                            <div class="reg logout">
                                <a href="<?=Url::to(['/user/security/logout'])?>"  data-method="post">Выйти</a>
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
                    <li><a href="<?=Url::to(['page/index', 'slug'=>'o-servise'])?>">О сервисе</a></li>
                    <li><a href="<?=Url::to(['page/index', 'slug'=>'pravila'])?>">Правила</a></li>
                    <li><a href="<?=Url::to(['page/help'])?>">Помощь</a></li>
                    <li><a href="<?=Url::to(['page/index', 'slug'=>'partneram'])?>">Партнерам</a></li>
                    <li><a href="<?=Url::to(['article/index'])?>">Блог</a></li>
                    <li><a href="<?=Url::to(['news/index'])?>">Новости</a></li>
                    <li><a href="<?=Url::to(['page/index', 'slug'=>'kontakty'])?>">Контакты</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.menu -->
    </div><!-- /.header -->


<div class="inner-wrapper inner-wrapper-auto account-page">
    <div class="container">
      <?=$this->render('/account/_menu')?>

        <?=$content?>

    </div>
</div><!-- /.inner-wrapper -->

<?php if(!empty($this->params['showFirms'])):
	$currencies = Currency::find()->all();
  ?>
    <?php $form = ActiveForm::begin([
            'id'=>'firms-form',
      'options'=>['class'=>'firms'],
    ])?>
    <div class="container">
        <div class="col">
            <?php foreach($currencies as $currency): ?>
            <div class="">
                <div class="image"><div class="image-wrapper">
                        <h4>
                          <?=$currency->getImage() ? Html::img($currency->getImage()->getUrl()) : ''?>
                        <?=$currency->title?></h4>
                    </div></div>

              <?php foreach($currency->fields as $field): ?>

                  <span><?=$field->title?></span>
                    <div class="form-group"><input type="text" name="currency[<?=$currency->id?>][fields][<?=$field->id?>]" <?php if($user_fields){?>value="<?=!empty($user_fields[$currency->id]) ? $user_fields[$currency->id][$field->id] : ''?>" <?php } ?>></div>

                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
            <?php endforeach; ?>
        </div>

        <?=Html::submitButton('Сохранить', ['class'=>'btn-save-firm'])?>
        <div class="clearfix"></div>
    </div>
<?php ActiveForm::end()?><!-- /.firms -->
<?php endif; ?>


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
	    <?= $form->field($user, 'source')->textInput(['maxlength' => 255,'placeholder'=>'Источник информации о сайте'])->label(false) ?>
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

<div id="reset_dialog">
    <div class="d-title">Восстановление</div>
    <form>
        <input type="text" placeholder="Email" />
        <input type="submit" value="Отправить" />
    </form>
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
