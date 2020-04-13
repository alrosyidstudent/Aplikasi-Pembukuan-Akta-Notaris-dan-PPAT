<?php 

namespace app\controllers;

use Yii;
use app\models\Akun;
use app\models\AktaBadan;
use app\models\AktaPpat;
use app\models\AktaNotaris;
use app\models\KategoriAkun;
use app\models\Notaris;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class AkunController extends Controller

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
        $model=new Akun();
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
		$model = new Akun;
		 $dataAkun = Akun::find()
            // ->where(['jenis'=>1])
            ->all();
		 return $this->render('index',compact('dataAkun'));
	}



	public function actionCreate()
    {
        $model = new Akun(); 
        if ($model->load(Yii::$app->request->post())){
            $model->insert();
            
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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


    protected function findModel($id)
        {
            if (($model = Akun::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
            
}

?>