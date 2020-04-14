<?php

namespace app\models;

use Yii;
use yii\base\Models;
use app\models\KategoriAkun;
use yii\db\ActiveRecord;

/**
 *
 */
class KategoriAkun extends yii\db\ActiveRecord
{

    // public $kode;
    // public $nama_kategori;


	public static function tableName()
	{
		return 'kategori_akun';
	}



public function attributesLabels()
	{
		 return [
            'id' => 'ID',
            'name'=>'Nama Kategori',

        ];

	}
 public function getTransaksi()
    {
        return $this->hasMany(Transaksi::className(), ['Kategori_akun_id' => 'id']);
    }

public static function getOptions(){
        $data=  static::find()
            ->select(['id','name'])
            ->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }


}
 ?>
