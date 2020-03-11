<?php

namespace app\controllers;

use app\models\Kota;
use yii\helpers\Json;

class KotaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionKota()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                //$cat_id = 4;
                $cat_id = $parents[0];
                $out = Kota::getKotaByProvinsi($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
}
