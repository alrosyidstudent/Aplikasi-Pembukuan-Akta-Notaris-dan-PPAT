<?php

namespace app\controllers;

use app\models\AktaBadanJenisSifat;
use Yii;
use app\models\AktaBadanJenis;
use app\models\AktaBadanJenisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * AktaBadanJenisController implements the CRUD actions for AktaBadanJenis model.
 */
class AktaBadanJenisController extends Controller
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


    public function actionSifat()
    {
        $model = new AktaBadanJenis();
        $modelsSifat = [new AktaBadanJenisSifat()];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsSifat = Model::createMultiple(AktaBadanJenisSifat::classname());
            Model::loadMultiple($modelsSifat, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsSifat),
                    ActiveForm::validate($model)
                );
            }

            foreach ($modelsSifat as $sifat) {
                $sifat->akta_badan_jenis_id = $model->id;
            }


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsSifat) && $valid;
            /*echo '<pre>';
            print_r($modelsPeserta);
            echo '</pre>';*/


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsSifat as $sifat) {
                            $sifat->akta_badan_jenis_id = $model->id;
                            if (!($flag = $sifat->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['akta-badan-jenis-sifat/index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('sifat', [
                'model' => $model,
                //'modelsTrainer' => (empty($modelsTrainer)) ? [new Trainer] : $modelsTrainer,
                'modelsSifat' => (empty($modelsSifat)) ? [new AktaBadanJenisSifat()] : $modelsSifat
            ]);
        }
    }


    public function actionUpdateSifat($id)
    {
        $msifat=AktaBadanJenisSifat::find()
            ->where(['id'=>$id])->one();

        $model = $this->findModel($msifat->akta_badan_jenis_id);
        $modelsSifat = $model->aktaBadanJenisSifats;

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsSifat, 'id', 'id');
            $modelsSifat = Model::createMultiple(AktaBadanJenisSifat::classname());
            Model::loadMultiple($modelsSifat, Yii::$app->request->post());

            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsSifat, 'id', 'id')));

            $n=0;
            foreach ($modelsSifat as $sifat) {
                $sifat->id = Yii::$app->request->post()['AktaBadanJenisSifat'][$n]['id'];
                $sifat->akta_badan_jenis_id = $model->id;
                $n++;
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsSifat) && $valid;

            /*echo '<pre>';
            print_r($modelsSifat);
            echo '</pre>';*/

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            AktaBadanJenisSifat::deleteAll(['id' => $deletedIDs]);
                        }

                        foreach ($modelsSifat as $sifat) {
                            $sifat->akta_badan_jenis_id = $model->id;
                            if (!($flag = $sifat->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id, 'training_types_id' => $model->training_types_id]);
                        return $this->redirect(['akta-badan-jenis-sifat/index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('update', [
                'model' => $model,
                'modelsSifat' => (empty($modelsSifat)) ? [new AktaBadanJenisSifat()] : $modelsSifat
            ]);
        }

    }


    /**
     * Lists all AktaBadanJenis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaBadanJenisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaBadanJenis model.
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
     * Creates a new AktaBadanJenis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaBadanJenis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaBadanJenis model.
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
     * Deletes an existing AktaBadanJenis model.
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
     * Finds the AktaBadanJenis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AktaBadanJenis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktaBadanJenis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
