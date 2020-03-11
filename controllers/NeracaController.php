<?php 
namespace app\controllers;

use Yii;


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

    
}

 ?>