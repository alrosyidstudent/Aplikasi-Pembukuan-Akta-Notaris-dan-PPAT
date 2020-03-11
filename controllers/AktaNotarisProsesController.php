<?php

namespace app\controllers;

use Yii;
use app\models\AktaNotarisProses;
use app\models\AktaNotarisProsesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaNotarisProsesController implements the CRUD actions for AktaNotarisProses model.
 */
class AktaNotarisProsesController extends Controller
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
     * Lists all AktaNotarisProses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaNotarisProsesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaNotarisProses model.
     * @param integer $akta_notaris_jenis_proses_id
     * @param integer $akta_notaris_id
     * @return mixed
     */
    public function actionView($akta_notaris_jenis_proses_id, $akta_notaris_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($akta_notaris_jenis_proses_id, $akta_notaris_id),
        ]);
    }

    /**
     * Creates a new AktaNotarisProses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akta_notaris_id)
    {
        $model = new AktaNotarisProses();
        $model->akta_notaris_id=$akta_notaris_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'akta_notaris_jenis_proses_id' => $model->akta_notaris_jenis_proses_id, 'akta_notaris_id' => $model->akta_notaris_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaNotarisProses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $akta_notaris_jenis_proses_id
     * @param integer $akta_notaris_id
     * @return mixed
     */
    public function actionUpdate($akta_notaris_jenis_proses_id, $akta_notaris_id)
    {
        $model = $this->findModel($akta_notaris_jenis_proses_id, $akta_notaris_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'akta_notaris_jenis_proses_id' => $model->akta_notaris_jenis_proses_id, 'akta_notaris_id' => $model->akta_notaris_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaNotarisProses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $akta_notaris_jenis_proses_id
     * @param integer $akta_notaris_id
     * @return mixed
     */
    public function actionDelete($akta_notaris_jenis_proses_id, $akta_notaris_id)
    {
        $this->findModel($akta_notaris_jenis_proses_id, $akta_notaris_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AktaNotarisProses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $akta_notaris_jenis_proses_id
     * @param integer $akta_notaris_id
     * @return AktaNotarisProses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($akta_notaris_jenis_proses_id, $akta_notaris_id)
    {
        if (($model = AktaNotarisProses::findOne(['akta_notaris_jenis_proses_id' => $akta_notaris_jenis_proses_id, 'akta_notaris_id' => $akta_notaris_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
