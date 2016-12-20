<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 20.12.16
 * Time: 6:21
 */

namespace app\modules\admin\controllers;


use app\models\User;
use nullref\admin\components\AdminController;

class SiteUserController extends AdminController
{
	/**
	 * @return false|null|string
	 */
	public function actionIndex(){
		$models = User::find()->all();

		return $this->render('index', [
			'models'=>$models
		]);
	}

}