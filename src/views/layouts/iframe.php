<?php
use app\assets\AppAsset;
use app\models\User;
use app\models\RegistrationForm;
use dektrium\user\models\LoginForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$bodyStyle = (Url::current() == '/iframe/view?type=small' ? 'style="min-width: 249px;"' : '');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<base target="_parent" />
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?php $this->head() ?>
</head>
<body <?=$bodyStyle?>>
<?php $this->beginBody() ?>
<?=$content?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
