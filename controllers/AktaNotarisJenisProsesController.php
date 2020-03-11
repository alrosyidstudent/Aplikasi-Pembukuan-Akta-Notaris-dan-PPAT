<?php

namespace app\controllers;

use Yii;
use app\models\AktaNotarisJenisProses;
use app\models\AktaNotarisJenisProsesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaNotarisJenisProsesController implements the CRUD actions for AktaNotarisJenisProses model.
 */
class AktaNotarisJenisProsesController extends Controller
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
     * Lists all AktaNotarisJenisProses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaNotarisJenisProsesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaNotarisJenisProses model.
     * @param integer $id
     * @param integer $akta_notaris_jenis_id
     * @return mixed
     */
    public function actionView($id, $akta_notaris_jenis_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $akta_notaris_jenis_id),
        ]);
    }

    /**
     * Creates a new AktaNotarisJenisProses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaNotarisJenisProses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'akta_notaris_jenis_id' => $model->akta_notaris_jenis_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaNotarisJenisProses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $akta_notaris_jenis_id
     * @return mixed
     */
    public function actionUpdate($id, $akta_notaris_jenis_id)
    {
        $model = $this->findModel($id, $akta_notaris_jenis_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'akta_notaris_jenis_id' => $model->akta_notaris_jenis_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaNotarisJenisProses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $akta_notaris_jenis_id
     * @return mixed
     */
    public function actionDelete($id, $akta_notaris_jenis_id)
    {
        $this->findModel($id, $akta_notaris_jenis_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AktaNotarisJenisProses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $akta_notaris_jenis_id
     * @return AktaNotarisJenisProses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $akta_notaris_jenis_id)
    {
        if (($model = AktaNotarisJenisProses::findOne(['id' => $id, 'akta_notaris_jenis_id' => $akta_notaris_jenis_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
