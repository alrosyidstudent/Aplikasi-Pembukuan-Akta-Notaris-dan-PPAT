<?php

namespace app\controllers;

use app\models\AktaNotarisJenisProses;
use Yii;
use app\models\AktaNotarisJenis;
use app\models\AktaNotarisJenisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/**
 * AktaNotarisJenisController implements the CRUD actions for AktaNotarisJenis model.
 */
class AktaNotarisJenisController extends Controller
{


    public function actionProses($id)
    {
        $check=AktaNotarisJenisProses::find()
            ->where(['akta_notaris_jenis_id'=>$id])
            ->asArray()->all();
        if(!count($check)>0){
            $model = $this->findModel($id);
            $modelsProses = [new AktaNotarisJenisProses()];
        }else{
            $model = $this->findModel($id);

            $modelsProses=AktaNotarisJenisProses::find()
                ->where(['akta_notaris_jenis_id'=>$id])
                ->all();
            $oldIDs = ArrayHelper::map($modelsProses, 'id', 'id');
        }


        if (Yii::$app->request->post()) {


            $modelsProses = Model::createMultiple(AktaNotarisJenisProses::classname());
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
                    $proses->akta_notaris_jenis_id = $id;
                    $proses->notaris_id=Yii::$app->user->identity->notaris_id;
                }
            }else{
                //$oldIDs = ArrayHelper::map($modelsProses, 'id', 'id');
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsProses, 'id', 'id')));


                $n=0;
                foreach ($modelsProses as $proses) {
                    $proses->akta_notaris_jenis_id = $id;
                    $proses->id = Yii::$app->request->post()['AktaNotarisJenisProses'][$n]['id'];
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
                        AktaNotarisJenisProses::deleteAll(['id' => $deletedIDs]);
                    }
                    //if ($flag = $model->save(false)) {
                    foreach ($modelsProses as $proses) {
                        $proses->akta_notaris_jenis_id = $id;
                        $proses->notaris_id = Yii::$app->user->identity->notaris_id;
                        if (!($flag = $proses->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    //}
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['akta-notaris-jenis/index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('proses', [
                'model' => $model,
                'modelsProses' => (empty($modelsProses)) ? [new AktaNotarisJenisProses()] : $modelsProses
            ]);
        }
    }

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
     * Lists all AktaNotarisJenis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaNotarisJenisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktaNotarisJenis model.
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
     * Creates a new AktaNotarisJenis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktaNotarisJenis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AktaNotarisJenis model.
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
     * Deletes an existing AktaNotarisJenis model.
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
     * Finds the AktaNotarisJenis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AktaNotarisJenis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktaNotarisJenis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
