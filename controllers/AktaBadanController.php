<?php

namespace app\controllers;

use app\models\AktaBadanJenisSifat;
use app\models\AktaNotaris;
use app\models\AktaPpat;
use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\Notaris;
use Yii;
use app\models\AktaBadan;
use app\models\AktaBadanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * AktaBadanController implements the CRUD actions for AktaBadan model.
 */
class AktaBadanController extends Controller
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

    public function actionJenis()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                //$cat_id = 4;
                $cat_id = $parents[0];
                $out = AktaBadanJenisSifat::getSifatByJenis($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Lists all AktaBadan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaBadanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaBadan model.
     * @param integer $id
     * @param integer $akta_badan_jenis_id
     * @return mixed
     */
    public function actionView($id, $akta_badan_jenis_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $akta_badan_jenis_id),
        ]);
    }

    /**
     * Creates a new AktaBadan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaBadan();

        if ($model->load(Yii::$app->request->post())) {
            $model->register = $this->generateRegister("register");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id, 'akta_badan_jenis_id' => $model->akta_badan_jenis_id]);
        } else {
            $not = Notaris::find()->where(['id'=>Yii::$app->user->identity->notaris_id])->one();
            $kelurahan = Kelurahan::find()->where(['id'=>$not->kelurahan_id])->one();
            $kecamatan = Kecamatan::find()->where(['id'=>$kelurahan->kecamatan])->one();
            $kabupaten = Kabupaten::find()->where(['id'=>$kecamatan->kabupaten])->one();

            //$model->kelurahan_id = $kelurahan->id;
            //$model->kecamatan_id = $kelurahan->kecamatan_id;
            $model->kabupaten_id = $kecamatan->kabupaten_id;
            $model->provinsi_id = $kabupaten->provinsi_id;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function generateRegister($attribute, $length = 8) {

        $randomString = strtoupper(Yii::$app->getSecurity()->generateRandomString($length));

        if((!$reg_model=AktaPpat::findOne([$attribute => $randomString]))
            and (!$reg_model=AktaBadan::findOne([$attribute => $randomString]))
            and (!$reg_model=AktaNotaris::findOne([$attribute => $randomString]))
        )
            return $randomString;
        else
            return $this->generateRegister($attribute, $length);

    }

    /**
     * Updates an existing AktaBadan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $akta_badan_jenis_id
     * @return mixed
     */
    public function actionUpdate($id, $akta_badan_jenis_id)
    {
        $model = $this->findModel($id, $akta_badan_jenis_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'akta_badan_jenis_id' => $model->akta_badan_jenis_id]);
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
     * Deletes an existing AktaBadan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $akta_badan_jenis_id
     * @return mixed
     */
    public function actionDelete($id, $akta_badan_jenis_id)
    {
        $this->findModel($id, $akta_badan_jenis_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AktaBadan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $akta_badan_jenis_id
     * @return AktaBadan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $akta_badan_jenis_id)
    {
        if (($model = AktaBadan::findOne(['id' => $id, 'akta_badan_jenis_id' => $akta_badan_jenis_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
