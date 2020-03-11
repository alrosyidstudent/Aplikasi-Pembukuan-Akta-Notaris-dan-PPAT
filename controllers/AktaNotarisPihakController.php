<?php

namespace app\controllers;

use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\Notaris;
use Yii;
use app\models\AktaNotarisPihak;
use app\models\AktaNotarisPihakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktaNotarisPihakController implements the CRUD actions for AktaNotarisPihak model.
 */
class AktaNotarisPihakController extends Controller
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
     * Lists all AktaNotarisPihak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaNotarisPihakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaNotarisPihak model.
     * @param integer $id
     * @param integer $akta_notaris_id
     * @return mixed
     */
    public function actionView($id, $akta_notaris_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $akta_notaris_id),
        ]);
    }

    /**
     * Creates a new AktaNotarisPihak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akta_notaris_id)
    {
        $model = new AktaNotarisPihak();
        $model->akta_notaris_id=$akta_notaris_id;
        $not = Notaris::find()->where(['id'=>Yii::$app->user->identity->notaris_id])->one();
        $kelurahan = Kelurahan::find()->where(['id'=>$not->kelurahan_id])->one();
        $kecamatan = Kecamatan::find()->where(['id'=>$kelurahan->kecamatan])->one();
        $kabupaten = Kabupaten::find()->where(['id'=>$kecamatan->kabupaten])->one();

        $model->kabupaten_id = $kecamatan->kabupaten_id;
        $model->provinsi_id = $kabupaten->provinsi_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id, 'akta_notaris_id' => $model->akta_notaris_id]);
            return $this->redirect(['akta-notaris/view', 'id' => $model->akta_notaris_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaNotarisPihak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $akta_notaris_id
     * @return mixed
     */
    public function actionUpdate()
    {
        if(isset(Yii::$app->request->post()['id'])){
            $id=Yii::$app->request->post()['id'];
            $akta_notaris_id=Yii::$app->request->post()['akta_notaris_id'];
            $model = $this->findModel($id, $akta_notaris_id);
        }else{
            $id=Yii::$app->request->post()['AktaNotarisPihak']['id'];
            $akta_notaris_id=Yii::$app->request->post()['AktaNotarisPihak']['akta_notaris_id'];
            $model = $this->findModel($id, $akta_notaris_id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['akta-notaris/view', 'id' => $model->akta_notaris_id]);
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
     * Deletes an existing AktaNotarisPihak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $akta_notaris_id
     * @return mixed
     */
    public function actionDelete()
    {
        $id=Yii::$app->request->post()['id'];
        $akta_notaris_id=Yii::$app->request->post()['akta_notaris_id'];
        $this->findModel($id, $akta_notaris_id)->delete();

        return $this->redirect(['akta-notaris/view', 'id' => $akta_notaris_id]);
        //$this->findModel($id, $akta_notaris_id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the AktaNotarisPihak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $akta_notaris_id
     * @return AktaNotarisPihak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $akta_notaris_id)
    {
        if (($model = AktaNotarisPihak::findOne(['id' => $id, 'akta_notaris_id' => $akta_notaris_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
