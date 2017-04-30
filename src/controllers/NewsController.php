<?php
/**
 * Created by PhpStorm.
 * User: rosl
 * Date: 12.12.16
 * Time: 7:05
 */

namespace app\controllers;


use app\models\News;
use yii\data\Pagination;
use yii\db\Expression;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{

	public function actions()
	{
		return [
				'error' => [
						'class' => 'yii\web\ErrorAction',
				],
		];
	}

	public function actionIndex(){
		$query = News::find()->where(['enabled'=>1])->orderBy('date DESC');

		$count = clone $query;
		$pages = new Pagination(['totalCount'=>$count->count(), 'pageSize'=>10]);
		$popular = News::find()->where(['enabled'=>1])->orderBy(new Expression('rand()'))->limit(3)->all();
		$pages->pageSizeParam = false;

		$models = $query->offset($pages->offset)
				->limit($pages->limit)
				->all();

		return $this->render('index', [
				'models'=>$models,
         'pages' => $pages,
				'popular'=>$popular
		]);
	}

	public function actionView($slug = ''){
		if($slug){
			$model = News::findOne(['slug'=>$slug]);
			$popular = News::find()->where(['enabled'=>1])->orderBy(new Expression('rand()'))->limit(3)->all();
			if(!$model){
				throw new NotFoundHttpException('not found');
			}
			return $this->render('view', [
					'model'=>$model,
					'popular'=>$popular
			]);
		}
		throw new NotFoundHttpException('not found');
	}

}
