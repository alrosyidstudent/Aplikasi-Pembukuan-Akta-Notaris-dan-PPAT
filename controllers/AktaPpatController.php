<?php

namespace app\controllers;

use app\models\AktaBadan;
use app\models\AktaNotaris;
use app\models\AktaPpatJenis;
use app\models\AktaPpatPihak;
use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\Notaris;
use Yii;
use app\models\AktaPpat;
use app\models\AktaPpatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * AktaPpatController implements the CRUD actions for AktaPpat model.
 */
class AktaPpatController extends Controller
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


    public function actionPihak($id)
    {
        $check=AktaPpatPihak::find()->where(['akta_ppat_id'=>$id])->count();
        if($check==0) {
            //$model = new AktaPpat();
            $model = AktaPpat::find()->where(['id' => $id])->one();
            $modelsPihak = [new AktaPpatPihak()];

            if ($model->load(Yii::$app->request->post())) {

                $modelsPihak = Model::createMultiple(AktaPpatPihak::classname());
                Model::loadMultiple($modelsPihak, Yii::$app->request->post());

                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsPihak),
                        ActiveForm::validate($model)
                    );
                }

                foreach ($modelsPihak as $pihak) {
                    $pihak->akta_ppat_id = $model->id;
                }


                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsPihak) && $valid;


                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            /*echo '<pre>';
                            print_r($flag);
                            echo '</pre>';*/
                            foreach ($modelsPihak as $pihak) {
                                $pihak->akta_ppat_id = $model->id;
                                if (!($flag = $pihak->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['akta-ppat/index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            } else {
                return $this->render('pihak', [
                    'model' => $model,
                    //'modelsTrainer' => (empty($modelsTrainer)) ? [new Trainer] : $modelsTrainer,
                    'modelsPihak' => (empty($modelsPihak)) ? [new AktaPpatPihak()] : $modelsPihak
                ]);
            }
        }else{
            //$mpihak=AktaPpatPihak::find()
            //    ->where(['id'=>$id])->one();

            $model = $this->findModel($id);
            $modelsPihak = $model->aktaPpatPihaks;
            /*echo '<pre>';
            print_r($modelsPihak);
            echo '</pre>';*/

            if ($model->load(Yii::$app->request->post())) {
                $oldIDs = ArrayHelper::map($modelsPihak, 'id', 'id');
                $modelsPihak = Model::createMultiple(AktaPpatPihak::classname());
                Model::loadMultiple($modelsPihak, Yii::$app->request->post());

                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPihak, 'id', 'id')));

                $n=0;
                foreach ($modelsPihak as $pihak) {
                    $pihak->id = Yii::$app->request->post()['AktaPpatPihak'][$n]['id'];
                    $pihak->akta_ppat_id = $model->id;
                    $n++;
                }

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsPihak) && $valid;

                /*echo '<pre>';
                print_r($modelsSifat);
                echo '</pre>';*/

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            if (!empty($deletedIDs)) {
                                AktaPpatPihak::deleteAll(['id' => $deletedIDs]);
                            }

                            foreach ($modelsPihak as $pihak) {
                                $pihak->akta_ppat_id = $model->id;
                                if (!($flag = $pihak->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            //return $this->redirect(['view', 'id' => $model->id, 'training_types_id' => $model->training_types_id]);
                            return $this->redirect(['akta-ppat/index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            }else{
                return $this->render('pihak', [
                    'model' => $model,
                    'modelsPihak' => (empty($modelsPihak)) ? [new AktaPpatPihak()] : $modelsPihak
                ]);
            }
        }
    }


    public function actionUpdatePihak($id)
    {
        $mpihak=AktaPpatPihak::find()
            ->where(['id'=>$id])->one();

        $model = $this->findModel($mpihak->akta_ppat_id);
        $modelsPihak = $model->aktaPpatPihaks;

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsPihak, 'id', 'id');
            $modelsPihak = Model::createMultiple(AktaPpatPihak::classname());
            Model::loadMultiple($modelsPihak, Yii::$app->request->post());

            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPihak, 'id', 'id')));

            $n=0;
            foreach ($modelsPihak as $pihak) {
                $pihak->id = Yii::$app->request->post()['AktaPpatPihak'][$n]['id'];
                $pihak->akta_ppat_id = $model->id;
                $n++;
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPihak) && $valid;

            /*echo '<pre>';
            print_r($modelsSifat);
            echo '</pre>';*/

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            AktaPpatPihak::deleteAll(['id' => $deletedIDs]);
                        }

                        foreach ($modelsPihak as $pihak) {
                            $pihak->akta_ppat_id = $model->id;
                            if (!($flag = $pihak->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id, 'training_types_id' => $model->training_types_id]);
                        return $this->redirect(['akta-ppat/index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('update', [
                'model' => $model,
                'modelsPihak' => (empty($modelsPihak)) ? [new AktaPpatPihak()] : $modelsPihak
            ]);
        }

    }

    /*public function actionJenis()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                //$cat_id = 4;
                $cat_id = $parents[0];
                $out = AktaPpatJenis::getSifatByJenis($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }*/

    /**
     * Lists all AktaPpat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaPpatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaPpat model.
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
     * Creates a new AktaPpat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaPpat();

        if ($model->load(Yii::$app->request->post())) {
            $model->register = $this->generateRegister("register");
            $model->nilai_pengalihan=Yii::$app->request->post()['AktaPpat']['nilai_pengalihan'];
            $model->njop_tanah=Yii::$app->request->post()['AktaPpat']['njop_tanah'];
            $model->njop_bangunan=Yii::$app->request->post()['AktaPpat']['njop_bangunan'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->id, 'akta_ppat_jenis_id' => $model->akta_ppat_jenis_id]);
            /*echo "<pre>";
            print_r($model);
            //print_r(Yii::$app->request->post());
            echo "</pre>";*/
        } else {
            $not = Notaris::find()->where(['id'=>Yii::$app->user->identity->notaris_id])->one();
            $kelurahan = Kelurahan::find()->where(['id'=>$not->kelurahan_id])->one();
            $kecamatan = Kecamatan::find()->where(['id'=>$kelurahan->kecamatan])->one();
            $kabupaten = Kabupaten::find()->where(['id'=>$kecamatan->kabupaten])->one();

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
     * Updates an existing AktaPpat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->nilai_pengalihan=Yii::$app->request->post()['AktaPpat']['nilai_pengalihan'];
            $model->njop_tanah=Yii::$app->request->post()['AktaPpat']['njop_tanah'];
            $model->njop_bangunan=Yii::$app->request->post()['AktaPpat']['njop_bangunan'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing AktaPpat model.
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
     * Finds the AktaPpat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AktaPpat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktaPpat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLaporan()
    {
        $tglawal = Yii::$app->request->post('akta-ppat')['tanggalawal'];
        $tglakhir = Yii::$app->request->post('akta-ppat')['tanggalakhir'];

        // $model = new AktaPpat();
        if ($tglawal==null&&$tglakhir==null) {
            $ppat = new AktaPpat;
            $model = AktaPpat::find()
            ->all();
        }else{  
           $model = AktaPpat::find()
            ->where(['between','tanggal', $tglawal, $tglakhir])
            ->all();
        }
        return $this->render('laporan', compact('ppat', 'model'));
    }
}