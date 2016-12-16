<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 16.12.16
 * Time: 17:45
 */

namespace app\controllers;


use yii\web\Controller;

class IframeController extends Controller
{

	public $layout = 'iframe';

	public function actionView($type){
		return $this->render($type);
	}

}