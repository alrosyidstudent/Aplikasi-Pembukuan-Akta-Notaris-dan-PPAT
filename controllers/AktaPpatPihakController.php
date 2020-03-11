<?php

namespace app\controllers;

use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\Notaris;
use Yii;
use app\models\AktaPpatPihak;
use app\models\AktaPpatPihakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaPpatPihakController implements the CRUD actions for AktaPpatPihak model.
 */
class AktaPpatPihakController extends Controller
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
     * Lists all AktaPpatPihak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaPpatPihakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaPpatPihak model.
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
     * Creates a new AktaPpatPihak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akta_ppat_id)
    {
        $model = new AktaPpatPihak();
        $model->akta_ppat_id=$akta_ppat_id;
        $not = Notaris::find()->where(['id'=>Yii::$app->user->identity->notaris_id])->one();
        $kelurahan = Kelurahan::find()->where(['id'=>$not->kelurahan_id])->one();
        $kecamatan = Kecamatan::find()->where(['id'=>$kelurahan->kecamatan])->one();
        $kabupaten = Kabupaten::find()->where(['id'=>$kecamatan->kabupaten])->one();

        $model->kabupaten_id = $kecamatan->kabupaten_id;
        $model->provinsi_id = $kabupaten->provinsi_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['akta-ppat/view', 'id' => $model->akta_ppat_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaPpatPihak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        if(isset(Yii::$app->request->post()['id'])){
            $id=Yii::$app->request->post()['id'];
            $akta_ppat_id=Yii::$app->request->post()['akta_ppat_id'];
            $model = $this->findModel($id, $akta_ppat_id);
        }else{
            $id=Yii::$app->request->post()['AktaPpatPihak']['id'];
            $akta_ppat_id=Yii::$app->request->post()['AktaPpatPihak']['akta_ppat_id'];
            $model = $this->findModel($id, $akta_ppat_id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['akta-ppat/view', 'id' => $model->akta_ppat_id]);
        } else {
            $kelurahan = Kelurahan::find()->where(['id'=>$model->kelurahan_id])->one();
            $kecamatan = Kecamatan::find()->where(['id'=>$kelurahan->kecamatan])->one();
            $kabupaten = Kabupaten::find()->where(['id'=>$kecamatan->kabupaten])->one();

            $model->kelurahan_id = $kelurahan->id;
            $model->kecamatan_id = $kelurahan->kecamatan_id;
            $model->kabupaten_id = $kecamatan->kabupaten_id;
            $model->provinsi_id = $kabupaten->provinsi_id;

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaPpatPihak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $id=Yii::$app->request->post()['id'];
        $akta_ppat_id=Yii::$app->request->post()['akta_ppat_id'];
        $this->findModel($id, $akta_ppat_id)->delete();

        return $this->redirect(['akta-ppat/view', 'id' => $akta_ppat_id]);
        //$this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the AktaPpatPihak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AktaPpatPihak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktaPpatPihak::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
