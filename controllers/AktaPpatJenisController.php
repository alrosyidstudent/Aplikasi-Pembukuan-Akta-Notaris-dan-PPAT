<?php

namespace app\controllers;

use app\models\AktaNotarisJenisProses;
use app\models\AktaPpatJenisProses;
use Yii;
use app\models\AktaPpatJenis;
use app\models\AktaPpatJenisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/**
 * AktaPpatJenisController implements the CRUD actions for AktaPpatJenis model.
 */
class AktaPpatJenisController extends Controller
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
     * Lists all AktaPpatJenis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaPpatJenisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaPpatJenis model.
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
     * Creates a new AktaPpatJenis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaPpatJenis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaPpatJenis model.
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
     * Deletes an existing AktaPpatJenis model.
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
     * Finds the AktaPpatJenis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AktaPpatJenis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktaPpatJenis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionProses($id)
    {
        $check=AktaPpatJenisProses::find()
            ->where(['akta_ppat_jenis_id'=>$id])
            ->asArray()->all();
        if(!count($check)>0){
            $model = $this->findModel($id);
            $modelsProses = [new AktaPpatJenisProses()];
        }else{
            $model = $this->findModel($id);

            $modelsProses=AktaPpatJenisProses::find()
                ->where(['akta_ppat_jenis_id'=>$id])
                ->all();
            $oldIDs = ArrayHelper::map($modelsProses, 'id', 'id');
        }


        if (Yii::$app->request->post()) {
            $modelsProses = Model::createMultiple(AktaPpatJenisProses::classname());
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
                    $proses->akta_ppat_jenis_id = $id;
                    $proses->notaris_id=Yii::$app->user->identity->notaris_id;
                }
            }else{
                //$oldIDs = ArrayHelper::map($modelsProses, 'id', 'id');
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsProses, 'id', 'id')));


                $n=0;
                foreach ($modelsProses as $proses) {
                    $proses->akta_ppat_jenis_id = $id;
                    $proses->id = Yii::$app->request->post()['AktaPpatJenisProses'][$n]['id'];
                    $proses->notaris_id = Yii::$app->user->identity->notaris_id;
                    $n++;
                }
            }

            // validate models
            $valid = Model::validateMultiple($modelsProses);

            /*echo '<pre>';
            print_r($modelsProses);
            echo '</pre>';*/

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (!empty($deletedIDs)) {
                        AktaPpatJenisProses::deleteAll(['id' => $deletedIDs]);
                    }
                    //if ($flag = $model->save(false)) {
                    foreach ($modelsProses as $proses) {
                        $proses->akta_ppat_jenis_id = $id;
                        $proses->notaris_id = Yii::$app->user->identity->notaris_id;
                        if (!($flag = $proses->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    //}
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['akta-ppat-jenis/index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('proses', [
                'model' => $model,
                'modelsProses' => (empty($modelsProses)) ? [new AktaPpatJenisProses()] : $modelsProses
            ]);
        }
    }

}
