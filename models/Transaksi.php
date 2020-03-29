<?php 

namespace app\models;

use Yii;
use app\models\Transaksi;

class Transaksi extends \yii\db\ActiveRecord
{

	
	public $nominal;
    public $kategori;
    public $tanggal;
    


	public static function tableName()
	
	{
		return 'transaksi';
	}


	public function rules()
	{

	return [
            [['notaris_id', 'akta_ppat_id','akta_notaris_id','akta_badan_id','akun_id'], 'required'],
            [['notaris_id', 'nominal','akun_id'], 'integer'],
            [['tanggal'], 'safe'	],
            [['kategori'], 'string', 'max' => 45],           
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
        ];
	}


	public function attributesLabels()
	{
		 return [
            'id' => 'ID',
            'kategori' => 'Kategori',
            'nominal' => 'Nominal',
            'tanggal' => 'Tanggal',
            'notaris_id' => 'Nama Notaris',
            'akta_ppat_id' => 'Akta PPAT',
            'akta_notaris_id' => 'Akta Notaris',
            'akta_badan_id' => 'Akta Badan',
            'akun_id' => 'Akun',
        ];

	}

    public function dataKategori(){
        return[
            1=>'Biaya Masuk Terkait Akta',
            2=>'Biaya Masuk Tidak Terkait Akta'
        ];

    }



	/**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }
    

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPPAT()
    {
        return $this->hasOne(AktaPpat::className(), ['id' => 'akta_ppat_id']);
    }
   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotaris()
    {
        return $this->hasOne(AktaNotaris::className(), ['id' => 'akta_notaris_id']);
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadan()
    {
        return $this->hasOne(AktaBadan::className(), ['id' => 'akta_badan_id']);
    }

    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkun()
    {
        return $this->hasOne(Akun::className(), ['id' => 'akun_id']);
    }

   

}

 ?>