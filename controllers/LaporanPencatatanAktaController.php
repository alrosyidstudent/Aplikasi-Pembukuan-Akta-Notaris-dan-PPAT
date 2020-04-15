<?php

namespace app\controllers;

use Yii;
use app\models\AktaNotaris;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LaporanPencatatanAktaController implements the CRUD actions for AktaNotaris model.
 */
class LaporanPencatatanAktaController extends Controller
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
     * Lists all AktaNotaris models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AktaNotaris::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaNotaris model.
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
     * Creates a new AktaNotaris model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaNotaris();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaNotaris model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaNotaris model.
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
     * Finds the AktaNotaris model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AktaNotaris the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktaNotaris::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionJanuari()
    {
        $title = 'Laporan Periode Bulan Januari';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 1 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionFebruari()
    {
        $title = 'Laporan Periode Bulan Februari';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 2 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionMaret()
    {
        $title = 'Laporan Periode Bulan Maret';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 3 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApril()
    {
        $title = 'Laporan Periode Bulan April';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 4 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionMei()
    {
        $title = 'Laporan Periode Bulan Mei';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 5 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionJuni()
    {
        $title = 'Laporan Periode Bulan Juni';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 6 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionJuli()
    {
        $title = 'Laporan Periode Bulan Juli';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 7 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAgustus()
    {
        $title = 'Laporan Periode Bulan Agustus';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 8 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSeptember()
    {
        $title = 'Laporan Periode Bulan September';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 9 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionOktober()
    {
        $title = 'Laporan Periode Bulan Oktober';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 10 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionNovember()
    {
        $title = 'Laporan Periode Bulan November';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 11 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDesember()
    {
        $title = 'Laporan Periode Bulan Desember';
        $query = AktaNotaris::find()->where(['MONTH(tanggal)' => 12 ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
            // 'query' => AktaNotaris::find()
        ]);

        return $this->render('view', [
            'title' => $title,
            'dataProvider' => $dataProvider,
        ]);
    }
}
