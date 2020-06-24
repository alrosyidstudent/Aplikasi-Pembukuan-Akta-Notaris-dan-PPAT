<?php

namespace app\controllers;

use Yii;
use app\models\Neraca;
use app\models\Depresiasi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NeracaController implements the CRUD actions for Akun model.
 */
class NeracaController extends Controller
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
     * Lists all Akun models.
     * @return mixed
     */
    public function actionIndex()
    {

        $tgl1=Yii::$app->request->post('Neraca')['tanggalperiodeawal'];
        $tgl2=Yii::$app->request->post('Neraca')['tanggalperiodeakhir'];
        //$tgl2 = date('tanggalperiode', strtotime('today -30 days'));

        $model = new Neraca;

        if ($tgl1==null&&$tgl2==null) {
            $model = new Neraca;
            $dataAktivaLancar = Neraca::find()       
            ->where(['between','kategori_akun_id','33','35' ])
            ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
            ->all();
        }else{  
           $dataAktivaLancar = Neraca::find()       
            ->where(['between','kategori_akun_id','33','35' ])
            ->andwhere(['between','tanggal', $tgl1, $tgl2])
            ->all();
        }

        if ($tgl1==null&&$tgl2==null) {
            $dataAktivaTetap= Neraca::find()
            ->where(['kategori_akun_id'=>36])
            ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
            ->all();
        }else{
            $dataAktivaTetap= Neraca::find()
            ->where(['kategori_akun_id'=>36])
            ->andwhere(['between','tanggal',$tgl1, $tgl2])
            ->all();
        }

        if ($tgl1==null&&$tgl2==null) {
        $dataEkuitas= Neraca::find()
            ->where(['kategori_akun_id'=>41])
            ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
            ->all();
        }else{
        $dataEkuitas= Neraca::find()
            ->where(['kategori_akun_id'=>41])
            ->andwhere(['between','tanggal', $tgl1, $tgl2])
            ->all();
        }

        if ($tgl1==null&&$tgl2==null) {
        $dataHutang= Neraca::find()
        ->where(['between','kategori_akun_id','38','40'])
        ->andwhere(['between','tanggal', '000-00-00', '000-00-00'])
        ->all();
        }else{
        $dataHutang= Neraca::find()
        ->where(['between','kategori_akun_id','38','40'])
        ->andwhere(['between','tanggal', $tgl1, $tgl2])
        ->all();
        }

        if ($tgl1==null&&$tgl2==null) {
        $dataDepresiasi= Depresiasi::find()
        ->where(['id'=>0])
        
        ->all();
        }else{
        $dataDepresiasi= Depresiasi::find()
        ->all();
        }

         return $this->render('index',compact('dataAktivaLancar','dataAktivaTetap','dataEkuitas','dataHutang','model','dataDepresiasi','tgl1','tgl2'));
    }

    
    protected function findModel($id)
    {
        if (($model = Akun::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
