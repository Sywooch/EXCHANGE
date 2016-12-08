<?php
use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
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
                    <a href="#"><span>Web-</span>obmen.net</a>
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
                        <div>
                            <div class="login">
                                <a href="#">Войти</a>
                            </div>
                            <div class="reg">
                                <a href="#">Регистрация</a>
                            </div>
                        </div>
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
                    <li><a href="#">Обмен валют</a></li>
                    <li><a href="#">О сервисе</a></li>
                    <li><a href="#">Правила</a></li>
                    <li><a href="#">Помощь</a></li>
                    <li><a href="#">Партнерам</a></li>
                    <li><a href="#">Блог</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.menu -->
    </div><!-- /.header -->
    <?=$content?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
