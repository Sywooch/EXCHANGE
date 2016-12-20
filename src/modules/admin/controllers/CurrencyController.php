<?php

namespace app\modules\admin\controllers;

use app\models\CurrencyFields;
use Yii;
use app\models\Currency;
use app\modules\admin\models\CurrencySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CurrencyController implements the CRUD actions for Currency model.
 */
class CurrencyController extends Controller
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
     * Lists all Currency models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CurrencySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Currency model.
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
     * Creates a new Currency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Currency();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'icon');
            if($file){
                if($model->getImage()){
                    $model->removeImage($model->getImage());
                }
                $path = Yii::getAlias('@webroot').'/images/';
                $file->saveAs($path . $file->baseName . '.' . $file->extension);
                $model->attachImage($path . $file->baseName . '.' . $file->extension);
            }

            $this->processFields($model);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Currency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'icon');
            if($file){
                if($model->getImage()){
                    $model->removeImage($model->getImage());
                }
                $path = Yii::getAlias('@webroot').'images/';
                $file->saveAs($path . $file->baseName . '.' . $file->extension);
                $model->attachImage($path . $file->baseName . '.' . $file->extension);
            }

						$this->processFields($model);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Currency model.
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
     * Finds the Currency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Currency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Currency::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function processFields(Currency $model){
    	$fields = Yii::$app->request->post('CurrencyFields');

    	CurrencyFields::deleteAll(['currency_id'=>$model->id]);
    	foreach($fields['title'] as $fieldd){
    		if($fieldd){
					$field = new CurrencyFields();
					$field->currency_id = $model->id;
					$field->title = $fieldd;
					$field->save();
				}
			}
		}
}
