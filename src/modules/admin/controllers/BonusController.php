<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 20.12.16
 * Time: 20:30
 */

namespace app\modules\admin\controllers;


use app\models\Bonus;
use nullref\admin\components\AdminController;

class BonusController extends AdminController
{

	public function actionIndex() {

		$models = Bonus::find()->all();

		if(\Yii::$app->request->post('bonus')){
			$post = \Yii::$app->request->post('bonus');
			Bonus::deleteAll();
			foreach($post as $bonus){
				if($bonus){
					$model = new Bonus();
					$model->setAttributes($bonus);
					$model->save();
				}
			}
		}

		return $this->render('index', [
				'models'=>$models
		]);

	}

}