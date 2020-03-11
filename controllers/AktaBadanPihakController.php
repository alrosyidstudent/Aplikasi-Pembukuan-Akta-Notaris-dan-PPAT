<?php

namespace app\controllers;

use Yii;
use app\models\AktaBadanPihak;
use app\models\AktaBadanPihakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaBadanPihakController implements the CRUD actions for AktaBadanPihak model.
 */
class AktaBadanPihakController extends Controller
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
     * Lists all AktaBadanPihak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaBadanPihakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaBadanPihak model.
     * @param integer $id
     * @param integer $akta_badan_id
     * @param integer $akta_badan_akta_badan_jenis_id
     * @return mixed
     */
    public function actionView($id, $akta_badan_id, $akta_badan_akta_badan_jenis_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $akta_badan_id, $akta_badan_akta_badan_jenis_id),
        ]);
    }

    /**
     * Creates a new AktaBadanPihak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaBadanPihak();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'akta_badan_id' => $model->akta_badan_id, 'akta_badan_akta_badan_jenis_id' => $model->akta_badan_akta_badan_jenis_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaBadanPihak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $akta_badan_id
     * @param integer $akta_badan_akta_badan_jenis_id
     * @return mixed
     */
    public function actionUpdate($id, $akta_badan_id, $akta_badan_akta_badan_jenis_id)
    {
        $model = $this->findModel($id, $akta_badan_id, $akta_badan_akta_badan_jenis_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'akta_badan_id' => $model->akta_badan_id, 'akta_badan_akta_badan_jenis_id' => $model->akta_badan_akta_badan_jenis_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaBadanPihak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $akta_badan_id
     * @param integer $akta_badan_akta_badan_jenis_id
     * @return mixed
     */
    public function actionDelete($id, $akta_badan_id, $akta_badan_akta_badan_jenis_id)
    {
        $this->findModel($id, $akta_badan_id, $akta_badan_akta_badan_jenis_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AktaBadanPihak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $akta_badan_id
     * @param integer $akta_badan_akta_badan_jenis_id
     * @return AktaBadanPihak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $akta_badan_id, $akta_badan_akta_badan_jenis_id)
    {
        if (($model = AktaBadanPihak::findOne(['id' => $id, 'akta_badan_id' => $akta_badan_id, 'akta_badan_akta_badan_jenis_id' => $akta_badan_akta_badan_jenis_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
