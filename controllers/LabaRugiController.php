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
        $model = new LabaRugi;
        $dataPendapatan = LabaRugi::find()
        ->where(['jenis'=>1])
        ->all();
        $dataBiayaOperasional = LabaRugi::find()
        ->where(['kategori_akun_id'=>43])
        ->all();
        $dataBiayaLainnya = LabaRugi::find()
        ->where(['kategori_akun_id'=>45])
        ->all();
        $dataPendapatanLainnya = LabaRugi::find()
        ->where(['kategori_akun_id'=>44])
        ->all();
         return $this->render('index',compact('dataPendapatan','dataBiayaOperasional','dataBiayaLainnya','dataPendapatanLainnya'));
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
