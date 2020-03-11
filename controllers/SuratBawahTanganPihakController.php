<?php

namespace app\controllers;

use Yii;
use app\models\SuratBawahTanganPihak;
use app\models\SuratBawahTanganPihakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuratBawahTanganPihakController implements the CRUD actions for SuratBawahTanganPihak model.
 */
class SuratBawahTanganPihakController extends Controller
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
     * Lists all SuratBawahTanganPihak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratBawahTanganPihakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratBawahTanganPihak model.
     * @param integer $id
     * @param integer $surat_bawah_tangan_id
     * @return mixed
     */
    public function actionView($id, $surat_bawah_tangan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $surat_bawah_tangan_id),
        ]);
    }

    /**
     * Creates a new SuratBawahTanganPihak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SuratBawahTanganPihak();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'surat_bawah_tangan_id' => $model->surat_bawah_tangan_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SuratBawahTanganPihak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $surat_bawah_tangan_id
     * @return mixed
     */
    public function actionUpdate($id, $surat_bawah_tangan_id)
    {
        $model = $this->findModel($id, $surat_bawah_tangan_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'surat_bawah_tangan_id' => $model->surat_bawah_tangan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SuratBawahTanganPihak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $surat_bawah_tangan_id
     * @return mixed
     */
    public function actionDelete($id, $surat_bawah_tangan_id)
    {
        $this->findModel($id, $surat_bawah_tangan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SuratBawahTanganPihak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $surat_bawah_tangan_id
     * @return SuratBawahTanganPihak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $surat_bawah_tangan_id)
    {
        if (($model = SuratBawahTanganPihak::findOne(['id' => $id, 'surat_bawah_tangan_id' => $surat_bawah_tangan_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
