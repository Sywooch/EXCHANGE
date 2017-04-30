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
        "css/styles.css",
		"css/scrollbar.css",
		"css/dd.css",
		"css/normalize.css",
    ];
    public $js = [
        //"js/jquery-3.1.1.min.js",		
		//"js/script.min.js",
		"js/script.js",
		"js/events.js",
		"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js",
		"https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js",
        'js/tools.js',
        'js/scripts.js?d=9028139',
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
