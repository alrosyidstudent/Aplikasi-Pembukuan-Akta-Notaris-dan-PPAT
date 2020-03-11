<?php

namespace app\controllers;

use Yii;
use app\models\AktaPpatProses;
use app\models\AktaPpatProsesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaPpatProsesController implements the CRUD actions for AktaPpatProses model.
 */
class AktaPpatProsesController extends Controller
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
     * Lists all AktaPpatProses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaPpatProsesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaPpatProses model.
     * @param integer $akta_ppat_id
     * @param integer $akta_ppat_jenis_proses_id
     * @return mixed
     */
    public function actionView($akta_ppat_id, $akta_ppat_jenis_proses_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($akta_ppat_id, $akta_ppat_jenis_proses_id),
        ]);
    }

    /**
     * Creates a new AktaPpatProses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akta_ppat_id)
    {
        $model = new AktaPpatProses();
        $model->akta_ppat_id = $akta_ppat_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'akta_ppat_id' => $model->akta_ppat_id, 'akta_ppat_jenis_proses_id' => $model->akta_ppat_jenis_proses_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaPpatProses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $akta_ppat_id
     * @param integer $akta_ppat_jenis_proses_id
     * @return mixed
     */
    public function actionUpdate($akta_ppat_id, $akta_ppat_jenis_proses_id)
    {
        $model = $this->findModel($akta_ppat_id, $akta_ppat_jenis_proses_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'akta_ppat_id' => $model->akta_ppat_id, 'akta_ppat_jenis_proses_id' => $model->akta_ppat_jenis_proses_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaPpatProses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $akta_ppat_id
     * @param integer $akta_ppat_jenis_proses_id
     * @return mixed
     */
    public function actionDelete($akta_ppat_id, $akta_ppat_jenis_proses_id)
    {
        $this->findModel($akta_ppat_id, $akta_ppat_jenis_proses_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AktaPpatProses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $akta_ppat_id
     * @param integer $akta_ppat_jenis_proses_id
     * @return AktaPpatProses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($akta_ppat_id, $akta_ppat_jenis_proses_id)
    {
        if (($model = AktaPpatProses::findOne(['akta_ppat_id' => $akta_ppat_id, 'akta_ppat_jenis_proses_id' => $akta_ppat_jenis_proses_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
