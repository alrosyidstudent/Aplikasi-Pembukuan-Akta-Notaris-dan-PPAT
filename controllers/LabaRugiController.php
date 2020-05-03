<?php

namespace app\controllers;

use Yii;
use app\models\LabaRugi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * LabaRugiController implements the CRUD actions for LabaRugi model.
 */
class LabaRugiController extends Controller
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
     * Lists all LabaRugi models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $tgl1 = $this->LabaRugi($tanggal);
        // $tgl2 = $this->LabaRugi($tanggal2);

        // $model =$this->findModel($tanggal);
        // $model =$this->findModel($tanggal2);


        $tgl1=Yii::$app->request->post('LabaRugi')['tanggalawal'];
        $tgl2=Yii::$app->request->post('LabaRugi')['tanggalakhir']; 
    
            // $tgl1 = '2020-04-09';
            // $tgl2 = '2020-04-10';     

        
    if ($tgl1==null&&$tgl2==null) {
        $model = new LabaRugi;
        $dataPendapatan = LabaRugi::find()        
        ->where(['jenis'=>1])
        ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
        ->all();
    }else{  
        $model = new LabaRugi;
        $dataPendapatan = LabaRugi::find() 
        ->where(['jenis'=>1])
        ->andwhere(['between','tanggal', $tgl1, $tgl2])
        ->all();
    }

    if ($tgl1==null&&$tgl2==null) {
        $dataBiayaOperasional = LabaRugi::find()
        ->where(['kategori_akun_id'=>43])
        ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
        ->all();
    }else{
        $dataBiayaOperasional = LabaRugi::find()
        ->where(['kategori_akun_id'=>43])
        ->andwhere(['between','tanggal', $tgl1, $tgl2])
        ->all();
    }

    if ($tgl1==null&&$tgl2==null) {
        $dataBiayaLainnya = LabaRugi::find()
        ->where(['kategori_akun_id'=>45])
        ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
        // ->andwhere(['between','tanggal', $tgl1, $tgl2])
        ->all();
    }else{
        $dataBiayaLainnya = LabaRugi::find()
        ->where(['kategori_akun_id'=>45])
        ->andwhere(['between','tanggal', $tgl1, $tgl2])
        ->all();
    }

    if ($tgl1==null&&$tgl2==null) {
        $dataPendapatanLainnya = LabaRugi::find()
        ->where(['kategori_akun_id'=>44])
        ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
        // ->andwhere(['between','tanggal', $tgl1, $tgl2])
        ->all();
    }else{
        $dataPendapatanLainnya = LabaRugi::find()
        ->where(['kategori_akun_id'=>44])
        ->andwhere(['between','tanggal', $tgl1, $tgl2])
        ->all();
    }

         return $this->render('index',compact('dataPendapatan','dataBiayaOperasional','dataBiayaLainnya','dataPendapatanLainnya','model','tgl1','tgl2'));
    }

    protected function findModel($id)
    {
        if (($model = LabaRugi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
