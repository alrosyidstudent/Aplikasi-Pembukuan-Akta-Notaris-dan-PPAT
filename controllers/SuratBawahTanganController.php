<?php

namespace app\controllers;

use app\models\SuratBawahTanganPihak;
use Yii;
use app\models\SuratBawahTangan;
use app\models\SuratBawahTanganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * SuratBawahTanganController implements the CRUD actions for SuratBawahTangan model.
 */
class SuratBawahTanganController extends Controller
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
     * Lists all SuratBawahTangan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratBawahTanganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratBawahTangan model.
     * @param integer $id
     * @param integer $surat_sifat_id
     * @return mixed
     */
    public function actionView($id, $surat_sifat_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $surat_sifat_id),
        ]);
    }

    /**
     * Creates a new SuratBawahTangan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SuratBawahTangan();
        $modelsPihak = [new SuratBawahTanganPihak()];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelsPihak = Model::createMultiple(SuratBawahTanganPihak::classname());
            Model::loadMultiple($modelsPihak, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                //ActiveForm::validateMultiple($modelsTrainer),
                    ActiveForm::validateMultiple($modelsPihak),
                    ActiveForm::validate($model)
                );
            }

            foreach ($modelsPihak as $pihak) {
                $pihak->surat_bawah_tangan_id = $model->id;
            }


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPihak) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPihak as $pihak) {
                            $pihak->surat_bawah_tangan_id = $model->id;
                            //$pihak->training_training_types_id = $model->training_types_id;
                            if (!($flag = $pihak->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['index']);
                        return $this->redirect(['view', 'id' => $model->id, 'surat_sifat_id' => $model->surat_sifat_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            //return $this->redirect(['view', 'id' => $model->id, 'training_types_id' => $model->training_types_id, 'site_id' => $model->site_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                //'modelsTrainer' => (empty($modelsTrainer)) ? [new Trainer] : $modelsTrainer,
                'modelsPihak' => (empty($modelsPihak)) ? [new SuratBawahTanganPihak] : $modelsPihak
            ]);
        }

    }

    /**
     * Updates an existing SuratBawahTangan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $surat_sifat_id
     * @return mixed
     */
    public function actionUpdate($id, $surat_sifat_id)
    {
        $model = $this->findModel($id, $surat_sifat_id);
        $modelsPihak = $model->suratBawahTanganPihaks;


        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsPihak, 'id', 'id');
            $modelsPihak = Model::createMultiple(SuratBawahTanganPihak::classname());
            Model::loadMultiple($modelsPihak, Yii::$app->request->post());

            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPihak, 'id', 'id')));

            $n=0;
            foreach ($modelsPihak as $pihak) {
                $pihak->id = Yii::$app->request->post()['TrainingPihak'][$n]['id'];
                $n++;
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPihak) && $valid;
            /*echo '<pre>';
            print_r(Yii::$app->request->post()['TrainingPeserta']);
            echo '</pre>';*/

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            SuratBawahTanganPihak::deleteAll(['id' => $deletedIDs]);
                        }

                        foreach ($modelsPihak as $pihak) {
                            $pihak->surat_bawah_tangan_id = $model->id;
                            if (!($flag = $pihak->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id, 'surat_sifat_id' => $model->surat_sifat_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('update', [
                'model' => $model,
                'modelsPihak' => (empty($modelsPihak)) ? [new SuratBawahTanganPihak] : $modelsPihak
            ]);
        }

        /*$model = $this->findModel($id, $surat_sifat_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'surat_sifat_id' => $model->surat_sifat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Deletes an existing SuratBawahTangan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $surat_sifat_id
     * @return mixed
     */
    public function actionDelete($id, $surat_sifat_id)
    {
        $this->findModel($id, $surat_sifat_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SuratBawahTangan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $surat_sifat_id
     * @return SuratBawahTangan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $surat_sifat_id)
    {
        if (($model = SuratBawahTangan::findOne(['id' => $id, 'surat_sifat_id' => $surat_sifat_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
