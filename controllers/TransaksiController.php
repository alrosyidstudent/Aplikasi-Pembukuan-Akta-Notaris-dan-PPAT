<?php 

namespace app\controllers;

use Yii;
use app\models\Transaksi;
use app\models\TransaksiSearch;
use app\models\AktaBadan;
use app\models\AktaPpat;
use app\models\AktaNotaris;

use app\models\KategoriAkun;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;




class TransaksiController extends Controller

{

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
        $model=new Transaksi();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (Yii::$app->request->isAjax) {
                    // JSON response is expected in case of successful save
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                }
                return $this->redirect(['index', 'id' => $model->id]);
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


    public function actionIndex()
        {
        // $searchModel = new TransaksiSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     //'dataProvider' => $dataProvider,
        // ]);
            $model = new Transaksi;
            $dataTransaksi = Transaksi::find()
            ->where(['jenis'=>1])
            ;
         return $this->render('index',compact('dataTransaksi','model'));
        }
        

    public function actionPengeluaran()
    {
        $model = new Transaksi;
        $dataTransaksi = Transaksi::find()
        ->where(['jenis'=>2])
        ->all();
         return $this->render('pengeluaran',compact('dataTransaksi'));
    }



     public function actionFilter()
        {
        // $searchModel = new TransaksiSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     //'dataProvider' => $dataProvider,
        // ]);
            $model = new Transaksi();
            $dataTransaksi = Transaksi::find()
            ->where(['tanggal'=>'2020-04-29'])
            ->all();
         return $this->render('index',compact('dataTransaksi','model'));
        }

    


     public function actionCreate()
    {
        $model = new Transaksi();

        
        if ($model->load(Yii::$app->request->post())) {
            $model->register = $this->generateRegister("register");
            $model->insert();
            /*echo "<pre>";
            print_r($model);
            echo "<pre>";*/
            return $this->redirect(['index', 'id' => $model->id]);
            
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


     public function actionCreate2()
    {
        $model = new Transaksi();

        
        if ($model->load(Yii::$app->request->post())) {
            $model->register = $this->generateRegister("register");
            $model->insert();
            /*echo "<pre>";
            print_r($model);
            echo "<pre>";*/
            return $this->redirect(['pengeluaran', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionDelete2($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['pengeluaran']);
    }



     public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate2($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['pengeluaran', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
        {
            if (($model = Transaksi::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
            

   
   

 
}


 ?>