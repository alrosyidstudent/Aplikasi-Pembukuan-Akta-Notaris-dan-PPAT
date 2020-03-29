<?php 

namespace app\controllers;

use Yii;
use app\models\Akun;
use app\model\KategoriAkun;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


class AkunController extends Controller

{

	public function actionIndex()
	{
		$model = new Akun;
		if($model->load(Yii::$app->request->post())&&$model->validate()){
			echo"suksess";
			die();
		}
		 return $this->render('index',compact('model'));
	}

	public function actionCreate()
	{
		$model = new Akun;
		if($model->load(Yii::$app->request->post())&&$model->validate()){
			echo"suksess";
			die();
		}
		 return $this->render('create',compact('model'));
	}

	public function actionUpdate()
	{
		$model = new Akun;
		if($model->load(Yii::$app->request->post())&&$model->validate()){
			echo"suksess";
			die();
		}
		 return $this->render('update',compact('model'));
	}



}

?>