<?php

namespace app\controllers;

use Yii;
use app\models\Transaksi;
use app\models\TransaksiSearch;
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
        $searchModel = new TransaksiSearch();
        $dataProvider = $searchModel->searchmasuk(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


     public function actionPengeluaran()
    {
        $searchModel = new TransaksiSearch();
        $dataProvider2 = $searchModel->searchkeluar(Yii::$app->request->queryParams);

        return $this->render('pengeluaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider2,
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
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateaktanotaris($akta_notaris_id)
    {
        $model = new Transaksi();
        $model->akta_notaris_id=$akta_notaris_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('createaktanotaris', [
                'model' => $model,
            ]);
        }
    }


     public function actionCreateaktabadan($akta_badan_id)
    {
        $model = new Transaksi();
        $model->akta_badan_id=$akta_badan_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('createaktabadan', [
                'model' => $model,
            ]);
        }
    }


    public function actionCreateaktappat($akta_ppat_id)
    {
        $model = new Transaksi();
        $model->akta_ppat_id=$akta_ppat_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('createaktappat', [
                'model' => $model,
            ]);
        }
    }

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
