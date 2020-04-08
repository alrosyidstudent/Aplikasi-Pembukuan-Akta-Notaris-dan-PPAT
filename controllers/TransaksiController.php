<?php 

namespace app\controllers;

use Yii;
use app\models\Transaksi;
use app\models\AktaBadan;
use app\models\AktaPpat;
use app\models\AktaNotaris;
use app\models\Akun;
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
            $model = new Transaksi;
            
             return $this->render('index'
         );
        }
        

    public function actionPengeluaran()
    {
        $model = new Transaksi;
        if($model->load(Yii::$app->request->post())&&$model->validate()){
            $model->save();
        }
         return $this->render('pengeluaran',compact('model'));
    }




    // public function actionCreate()
    // {
    //     $model = new Transaksi;
    //     if($model->load(Yii::$app->request->post())&&$model->validate()){
    //          $model->save();
    //          Yii::$app->session->setFlash('Success','Data berhasil Disimpan');

    //     }
    //      return $this->render('create',compact('model'));
    // }
    


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