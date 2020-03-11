<?php 

namespace app\models;

use Yii;
use app\models\Transaksi;

class Transaksi extends \yii\db\ActiveRecord
{

	$transaksi = Transaksi::find()->orderBy('kategori')->all();
	// public $transaksi

	// public static function tableName()
	
	// {
	// 	return 'transaksi';
	// }


	// public function rules()
	// {

	// return [
 //            [['notaris_id', 'akta_ppat_id','akta_notaris_id','akta_badan_id','akun_id'], 'required'],
 //            [['notaris_id', 'nominal','akun_id'], 'integer'],
 //            [['tanggal'], 'safe'	],
 //            [['kategori'], 'string', 'max' => 45],           
 //            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
 //        ];
	// }


	// public function attributesLabels()
	// {
	// 	 return [
 //            'id' => 'ID',
 //            'kategori' => 'Kategori',
 //            'nominal' => 'Nominal',
 //            'tanggal' => 'Tanggal',
 //            'notaris_id' => 'Nama Notaris',
 //            'akta_ppat_id' => 'Akta PPAT',
 //            'akta_notaris_id' => 'Akta Notaris',
 //            'akta_badan_id' => 'Akta Badan',
 //            'akun_id' => 'Akun',
 //        ];

	// }



}

 ?>