<?php 

namespace app\controllers;

use Yii;
use app\models\Transaksi;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;




class TransaksiController extends Controller

{

	public function actionIndex()
    {
        $model = new Transaksi;
        if($model->load(Yii::$app->request->post())&&$model->validate()){
            echo"suksess";
            die();
        }
         return $this->render('index',compact('model'));
    }

    public function actionPengeluaran()
    {
        $model = new Transaksi;
        if($model->load(Yii::$app->request->post())&&$model->validate()){
            echo"suksess";
            die();
        }
         return $this->render('pengeluaran',compact('model'));
    }

   

 
}


 ?>