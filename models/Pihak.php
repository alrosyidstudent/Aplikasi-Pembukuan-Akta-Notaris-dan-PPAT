<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "akta_badan_jenis".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AktaBadan[] $aktaBadans
 * @property AktaBadanJenisProses[] $aktaBadanJenisProses
 * @property AktaBadanJenisSifat[] $aktaBadanJenisSifats
 */
class Pihak
{
    public function getAktaBadans()
    {
        //return $this->hasMany(AktaBadan::className(), ['akta_badan_jenis_id' => 'id']);
    }

    public static function getPpatOptions(){
        $value=array(
            'Penjual'=>'Penjual',
            'Pembeli'=>'Pembeli',
            'Pemberi Kuasa' => 'Pemberi Kuasa',
            'Penerima Kuasa' => 'Penerima Kuasa',
            'Persetujuan' => 'Persetujuan',
            'Pemberi Hibah'=>'Pemberi Hibah',
            'Penerima Hibah'=>'Penerima Hibah',
            'Ahli Waris'=>'Ahli Waris'
        );
        return $value;
    }

}
