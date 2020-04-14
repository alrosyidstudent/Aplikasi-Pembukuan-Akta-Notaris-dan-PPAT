<?php 

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


class LaporanKeuanganController extends Controller

{

	public function actionIndex()
	{
		 return $this->render('index');
 	}

 	public function actionNeraca()
	{
		 return $this->render('neraca');
 	}

 	public function actionLabarugi()
	{
		 return $this->render('laba-rugi');
 	}
}

?>