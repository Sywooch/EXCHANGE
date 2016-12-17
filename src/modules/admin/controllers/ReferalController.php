<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 17.12.16
 * Time: 3:55
 */

namespace app\modules\admin\controllers;


use app\models\Referal;
use yii\web\Controller;

class ReferalController extends Controller
{

	public function actionIndex(){

		$users = Referal::find()->groupBy('user_id')->all();

		return $this->render('index', [
				'users' => $users
		]);
	}


}