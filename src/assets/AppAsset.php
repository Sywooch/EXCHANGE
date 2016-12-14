<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/normalize.css",
        "https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700&subset=cyrillic",
        "css/dd.css",
        "css/scrollbar.css",
        "css/owl.carousel.css",
        "css/main.css",
        'css/site.css',
    ];
    public $js = [
        "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js",
        'js/tools.js',
        'js/scripts.js',
        "js/jquery.dd.js",
        "js/icheck.min.js",
        "js/formstone/core.js",
        "js/formstone/touch.js",
        "js/formstone/scrollbar.js",
        "js/owl.carousel.min.js",
        "js/common.js",
        "js/forms.js",
        "js/index.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
