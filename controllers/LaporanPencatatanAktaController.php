<?php 

namespace app\controllers;

use app\models\AktaBadan;
use app\models\AktaPpat;
use app\models\AktaNotaris;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Model;

/**
 * 
 */
class LaporanPencatatanAktaController extends Controller
{	
	public function actionIndex()
	{
		$bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        return $this->render('index', [
            'Bulan' => $bulan
        ]);
	}
	
	public function actionDetail()
	{
		return $this->render('view');
	}
}

 ?>