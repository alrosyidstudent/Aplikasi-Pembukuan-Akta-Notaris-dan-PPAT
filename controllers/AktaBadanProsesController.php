<?php

namespace app\controllers;

use Yii;
use app\models\AktaBadanProses;
use app\models\AktaBadanProsesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaBadanProsesController implements the CRUD actions for AktaBadanProses model.
 */
class AktaBadanProsesController extends Controller
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
     * Lists all AktaBadanProses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaBadanProsesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaBadanProses model.
     * @param integer $akta_badan_jenis_proses_id
     * @param integer $akta_badan_id
     * @return mixed
     */
    public function actionView($akta_badan_jenis_proses_id, $akta_badan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($akta_badan_jenis_proses_id, $akta_badan_id),
        ]);
    }

    /**
     * Creates a new AktaBadanProses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaBadanProses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'akta_badan_jenis_proses_id' => $model->akta_badan_jenis_proses_id, 'akta_badan_id' => $model->akta_badan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaBadanProses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $akta_badan_jenis_proses_id
     * @param integer $akta_badan_id
     * @return mixed
     */
    public function actionUpdate($akta_badan_jenis_proses_id, $akta_badan_id)
    {
        $model = $this->findModel($akta_badan_jenis_proses_id, $akta_badan_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'akta_badan_jenis_proses_id' => $model->akta_badan_jenis_proses_id, 'akta_badan_id' => $model->akta_badan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaBadanProses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $akta_badan_jenis_proses_id
     * @param integer $akta_badan_id
     * @return mixed
     */
    public function actionDelete($akta_badan_jenis_proses_id, $akta_badan_id)
    {
        $this->findModel($akta_badan_jenis_proses_id, $akta_badan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AktaBadanProses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $akta_badan_jenis_proses_id
     * @param integer $akta_badan_id
     * @return AktaBadanProses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($akta_badan_jenis_proses_id, $akta_badan_id)
    {
        if (($model = AktaBadanProses::findOne(['akta_badan_jenis_proses_id' => $akta_badan_jenis_proses_id, 'akta_badan_id' => $akta_badan_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
