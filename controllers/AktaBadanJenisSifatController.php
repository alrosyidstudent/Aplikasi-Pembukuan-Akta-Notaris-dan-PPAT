<?php

namespace app\controllers;

use app\models\AktaBadanJenis;
use Yii;
use app\models\AktaBadanJenisSifat;
use app\models\AktaBadanJenisSifatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AktaBadanJenisProses;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/**
 * AktaBadanJenisSifatController implements the CRUD actions for AktaBadanJenisSifat model.
 */
class AktaBadanJenisSifatController extends Controller
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



    public function actionProses($id)
    {
        $check=AktaBadanJenisProses::find()
            ->where(['akta_badan_jenis_sifat_id'=>$id])
            ->asArray()->all();
        if(!count($check)>0){
            $model = $this->findModel($id);
            $modelsProses = [new AktaBadanJenisProses()];
        }else{
            $model = $this->findModel($id);

            $modelsProses=AktaBadanJenisProses::find()
                ->where(['akta_badan_jenis_sifat_id'=>$id])
                ->all();
            $oldIDs = ArrayHelper::map($modelsProses, 'id', 'id');
        }


        if (Yii::$app->request->post()) {
            $modelsProses = Model::createMultiple(AktaBadanJenisProses::classname());
            Model::loadMultiple($modelsProses, Yii::$app->request->post());

            if(!count($check)>0) {
                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsProses),
                        ActiveForm::validate($model)
                    );
                }

                foreach ($modelsProses as $proses) {
                    $proses->akta_badan_jenis_sifat_id = $id;
                    $proses->akta_badan_jenis_sifat_akta_badan_jenis_id=$model->akta_badan_jenis_id;
                }
            }else{
                //$oldIDs = ArrayHelper::map($modelsProses, 'id', 'id');
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsProses, 'id', 'id')));

                /*echo '<pre>';
                print_r($deletedIDs);
                echo '</pre>';*/

                $n=0;
                foreach ($modelsProses as $proses) {
                    $proses->akta_badan_jenis_sifat_id = $id;
                    $proses->akta_badan_jenis_sifat_akta_badan_jenis_id=$model->akta_badan_jenis_id;
                    $proses->id = Yii::$app->request->post()['AktaBadanJenisProses'][$n]['id'];
                    $n++;
                }
            }

            // validate models
            $valid = Model::validateMultiple($modelsProses);

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (!empty($deletedIDs)) {
                        AktaBadanJenisProses::deleteAll(['id' => $deletedIDs]);
                    }
                    //if ($flag = $model->save(false)) {
                    foreach ($modelsProses as $proses) {
                        $proses->akta_badan_jenis_sifat_id = $id;
                        $proses->akta_badan_jenis_sifat_akta_badan_jenis_id=$model->akta_badan_jenis_id;
                        $proses->notaris_id = Yii::$app->user->identity->notaris_id;
                        if (!($flag = $proses->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    //}
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['akta-badan-jenis-sifat/index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('proses', [
                'model' => $model,
                'modelsProses' => (empty($modelsProses)) ? [new AktaBadanJenisProses()] : $modelsProses
            ]);
        }
    }

    public function actionSifat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                }

                $out = AktaBadanJenisSifat::getSifatByJenis($cat_id);
                $selected = AktaBadanJenisSifat::getSifatSelected($param1);

                echo Json::encode(['output'=>$out, 'selected'=>$selected]);
                return;
            }

        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
        /*$out = [];
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
        echo Json::encode(['output' => '', 'selected' => '']);*/
    }


    /**
     * Lists all AktaBadanJenisSifat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaBadanJenisSifatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaBadanJenisSifat model.
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
     * Creates a new AktaBadanJenisSifat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($akta_badan_jenis_id)
    {
        $model = new AktaBadanJenisSifat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['akta-badan-jenis/index']);
        } else {
            $model->akta_badan_jenis_id=$akta_badan_jenis_id;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaBadanJenisSifat model.
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AktaBadanJenisSifat model.
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
     * Finds the AktaBadanJenisSifat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $akta_badan_jenis_id
     * @return AktaBadanJenisSifat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktaBadanJenisSifat::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
