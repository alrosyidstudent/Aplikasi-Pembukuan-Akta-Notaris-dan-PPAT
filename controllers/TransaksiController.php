<?php 

namespace app\controllers;

use Yii;
use app\model\Transakasi;
use yii\web\Controller;
use yii\data\Pagination;



class AktaBadanJenisController extends Controller

{

	public function actionIndex()
	{

		 $query = Transaksi::find();

		 $pagination = new pagination([
		 	'defaultPageSize' => 5,
		 	'totalCount' => $query->count(),
		 ]);

		 $transaksi = $query->orderBy('kategori')
		 ->offset($pagination->offset)
		 ->limit($pagination->limit)
		 ->all();

		 return $this->render('index',[
		 	'Transaksi' =>$transaksi,
		 	'pagination' => $pagination,
		 ]);
}

 
}


 ?>