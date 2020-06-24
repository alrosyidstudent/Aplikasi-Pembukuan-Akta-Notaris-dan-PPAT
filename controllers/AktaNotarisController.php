<?php

namespace app\controllers;

use app\models\AktaBadan;
use app\models\AktaPpat;
use app\models\AktaNotarisPihak;
use Yii;
use app\models\AktaNotaris;
use app\models\AktaNotarisSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * AktaNotarisController implements the CRUD actions for AktaNotaris model.
 */
class AktaNotarisController extends Controller
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

    public function actionModal()
    {
        return $this->render('modal');
    }


    public function actionModalt()
    {
        $model=new AktaNotaris();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (Yii::$app->request->isAjax) {
                    // JSON response is expected in case of successful save
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionPihak($id)
    {
        $check=AktaNotarisPihak::find()->where(['akta_notaris_id'=>$id])->count();
        if($check==0) {
            //$model = new AktaPpat();
            $model = AktaNotaris::find()->where(['id' => $id])->one();
            $modelsPihak = [new AktaNotarisPihak()];

            if ($model->load(Yii::$app->request->post())) {

                $modelsPihak = Model::createMultiple(AktaNotarisPihak::classname());
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
                    $pihak->akta_notaris_id = $model->id;
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
                                $pihak->akta_notaris_id = $model->id;
                                if (!($flag = $pihak->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['akta-notaris/index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            } else {
                return $this->render('pihak', [
                    'model' => $model,
                    'modelsPihak' => (empty($modelsPihak)) ? [new AktaNotarisPihak()] : $modelsPihak
                ]);
            }
        }else{
            //$mpihak=AktaPpatPihak::find()
            //    ->where(['id'=>$id])->one();

            $model = $this->findModel($id);
            $modelsPihak = $model->aktaNotarisPihaks;
            /*echo '<pre>';
            print_r($modelsPihak);
            echo '</pre>';*/

            if ($model->load(Yii::$app->request->post())) {
                $oldIDs = ArrayHelper::map($modelsPihak, 'id', 'id');
                $modelsPihak = Model::createMultiple(AktaNotarisPihak::classname());
                Model::loadMultiple($modelsPihak, Yii::$app->request->post());

                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPihak, 'id', 'id')));

                $n=0;
                foreach ($modelsPihak as $pihak) {
                    $pihak->id = Yii::$app->request->post()['AktaNotarisPihak'][$n]['id'];
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
                                AktaNotarisPihak::deleteAll(['id' => $deletedIDs]);
                            }

                            foreach ($modelsPihak as $pihak) {
                                $pihak->akta_notaris_id = $model->id;
                                if (!($flag = $pihak->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            //return $this->redirect(['view', 'id' => $model->id, 'training_types_id' => $model->training_types_id]);
                            return $this->redirect(['akta-notaris/index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            }else{
                return $this->render('pihak', [
                    'model' => $model,
                    'modelsPihak' => (empty($modelsPihak)) ? [new AktaNotarisPihak()] : $modelsPihak
                ]);
            }
        }
    }


    public function actionUpdatePihak($id)
    {
        $mpihak=AktaNotarisPihak::find()
            ->where(['id'=>$id])->one();

        $model = $this->findModel($mpihak->akta_notaris_id);
        $modelsPihak = $model->aktaNotarisPihaks;

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsPihak, 'id', 'id');
            $modelsPihak = Model::createMultiple(AktaNotarisPihak::classname());
            Model::loadMultiple($modelsPihak, Yii::$app->request->post());

            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPihak, 'id', 'id')));

            $n=0;
            foreach ($modelsPihak as $pihak) {
                $pihak->id = Yii::$app->request->post()['AktaNotarisPihak'][$n]['id'];
                $pihak->akta_notaris_id = $model->id;
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
                            AktaNotarisPihak::deleteAll(['id' => $deletedIDs]);
                        }

                        foreach ($modelsPihak as $pihak) {
                            $pihak->akta_notaris_id = $model->id;
                            if (!($flag = $pihak->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id, 'training_types_id' => $model->training_types_id]);
                        return $this->redirect(['akta-notaris/index']);
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

    /**
     * Lists all AktaNotaris models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktaNotarisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        
        if ($model->load(Yii::$app->request->post())) {
            $model->register = $this->generateRegister("register");
            $model->insert();
            /*echo "<pre>";
            print_r($model);
            echo "<pre>";*/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
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
    public function actionLaporan()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AktaNotaris::find(),
        ]);

        return $this->render('laporan', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
