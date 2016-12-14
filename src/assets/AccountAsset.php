<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 14.12.16
 * Time: 22:21
 */

namespace app\assets;


use yii\web\AssetBundle;

class AccountAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
	];
	public $js = [
			'js/admin/scripts.js',
	];
	public $depends = [
			'yii\web\YiiAsset',
	];
}