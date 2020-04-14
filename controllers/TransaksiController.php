<?php

namespace app\controllers;

use Yii;
use app\models\Transaksi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransaksiController implements the CRUD actions for Transaksi model.
 */
class TransaksiController extends Controller
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
     * Lists all Transaksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $search = Yii::$app->request->queryParams;
        $query= Transaksi::find()
            ->where(['jenis'=>1]);
            //->joinWith('keterangan');

       //  if (!empty($search['keterangan'])) {
       // $query->andFilterWhere(['like','keterangan',$search['keterangan']]);
        $dataProvider = new ActiveDataProvider([
            'query' =>$query,
        ]);
        //}

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionPengeluaran()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Transaksi::find()
            ->where(['jenis'=>2])
        ]);

        return $this->render('pengeluaran', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaksi model.
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
     * Creates a new Transaksi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaksi();
        //$model->register = $this->generateRegister("register");
        if ($model->load(Yii::$app->request->post()) && $model->insert()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    //  public function generateRegister($attribute, $length = 8) {

    //     $randomString = strtoupper(Yii::$app->getSecurity()->generateRandomString($length));

    //     if((!$reg_model=AktaPpat::findOne([$attribute => $randomString]))
    //         and (!$reg_model=AktaBadan::findOne([$attribute => $randomString]))
    //         and (!$reg_model=AktaNotaris::findOne([$attribute => $randomString]))
    //     )
    //         return $randomString;
    //     else
    //         return $this->generateRegister($attribute, $length);

    // }

    /**
     * Updates an existing Transaksi model.
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
     * Deletes an existing Transaksi model.
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
     * Finds the Transaksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
