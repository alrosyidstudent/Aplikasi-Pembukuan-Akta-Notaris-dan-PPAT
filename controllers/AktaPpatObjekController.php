<?php

namespace app\controllers;

use Yii;
use app\models\AktaPpatObjek;
use app\models\AktaPpatObjekSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaPpatObjekController implements the CRUD actions for AktaPpatObjek model.
 */
class AktaPpatObjekController extends Controller
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
     * Lists all AktaPpatObjek models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaPpatObjekSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaPpatObjek model.
     * @param integer $id
     * @param integer $akta_ppat_id
     * @return mixed
     */
    public function actionView($id, $akta_ppat_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $akta_ppat_id),
        ]);
    }

    /**
     * Creates a new AktaPpatObjek model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaPpatObjek();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'akta_ppat_id' => $model->akta_ppat_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaPpatObjek model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $akta_ppat_id
     * @return mixed
     */
    public function actionUpdate($id, $akta_ppat_id)
    {
        $model = $this->findModel($id, $akta_ppat_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'akta_ppat_id' => $model->akta_ppat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaPpatObjek model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $akta_ppat_id
     * @return mixed
     */
    public function actionDelete($id, $akta_ppat_id)
    {
        $this->findModel($id, $akta_ppat_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AktaPpatObjek model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $akta_ppat_id
     * @return AktaPpatObjek the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $akta_ppat_id)
    {
        if (($model = AktaPpatObjek::findOne(['id' => $id, 'akta_ppat_id' => $akta_ppat_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
