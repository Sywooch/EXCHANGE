<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Banner;
use app\modules\admin\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        	$file = UploadedFile::getInstance($model, 'image');

        	if($file){
        		$path = Yii::getAlias('@webroot').'/images/'.date('U').'.'.$file->extension;
        		$file->saveAs($path);
        		$model->attachImage($path);
        		$imgUrl = Yii::$app->homeUrl.$model->getImage()->getUrl();
        		$link = Yii::$app->homeUrl.'/?rid=<USERID>';
        		$code = '<a href="'.$link.'"><img alt="Обменник" title="Обменять" src="'.$imgUrl.'"></a>';
        		$model->code = $code;
        		$model->save();
					}


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
					$file = UploadedFile::getInstance($model, 'image');

					if($file){
						$path = Yii::getAlias('@webroot').'/images/'.date('U').'.'.$file->extension;
						$file->saveAs($path);
						$model->attachImage($path);
						$imgUrl = Yii::$app->homeUrl.$model->getImage()->getUrl();
						$link = Yii::$app->homeUrl.'/?rid=<USERID>';
						$code = '<a href="'.$link.'"><img alt="Обменник" title="Обменять" src="'.$imgUrl.'"></a>';
						$model->code = $code;
						$model->image = '/images/'.date('U').'.'.$file->extension;
						$model->save();
					}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
