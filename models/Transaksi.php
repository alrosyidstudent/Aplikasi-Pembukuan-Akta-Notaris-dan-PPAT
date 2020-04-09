<?php 

namespace app\models;

use Yii;
use app\models\Transaksi;
use yii\db\ActiveRecord;

class Transaksi extends \yii\db\ActiveRecord
{

	
	// public $nominal;
 //    public $kategori;
 //    public $tanggal;
    


	public static function tableName()
	
	{
		return 'transaksi';
	}


	public function rules()
	{

	return [
            [['notaris_id', 'kategori_akun_id'], 'required'],
            [['notaris_id', 'nominal','kategori_akun_id'], 'integer'],          
            [['keterangan','jenis'], 'string', 'max' => 45],           
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
            [['akta_ppat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaPpat::className(), 'targetAttribute' => ['akta_ppat_id' => 'id']],
            [['akta_notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaNotaris::className(), 'targetAttribute' => ['akta_notaris_id' => 'id']],
            [['akta_badan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadan::className(), 'targetAttribute' => ['akta_badan_id' => 'id']],
            [['kategori_akun_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriAkun::className(), 'targetAttribute' => ['kategori_akun_id' => 'id']],
            [['tanggal'], 'safe'    ],
        ];
	}


	public function attributesLabels()
	{
		 return [
            'id' => 'ID',
            'jenis' => 'Jenis Transaksi',
            'nominal' => 'Nominal',
            'tanggal' => 'Tanggal',
            'notaris_id' => 'Nama Notaris',
            'akta_ppat_id' => 'Akta PPAT',
            'akta_notaris_id' => 'Akta Notaris',
            'akta_badan_id' => 'Akta Badan',
            'kategori_akun_id' => 'Kategori',
            'register' => 'Register',
            'keterangan'=>'Keterangan'
        ];

	}

    public function dataJenisTransaksi(){
        return[
            1=>'Biaya Masuk',
            2=>'Biaya Keluar'          
        ];

    }

    public function labelJenis(){

        if ($this->jenis==1) {
            return 'Biaya Masuk';
        }else if ($this->jenis==2) {
            return 'Biaya Keluar';
        }else{
            return 'jenis tidak diketahui';
        }

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
    public function getKategoriAkun()
    {
        return $this->hasOne(KategoriAkun::className(), ['id' => 'kategori_akun_id']);
    }
    public  function getKategori()
    {
        return $this->KategoriAkun->name;
    }
    
}

 ?>