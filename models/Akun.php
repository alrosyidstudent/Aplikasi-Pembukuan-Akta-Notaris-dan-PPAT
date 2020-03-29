<?php 

namespace app\models;

use Yii;
use yii\base\Models;
use app\models\Transaksi;
use app\models\KategoriAkun;
use yii\db\ActiveRecord;

class Akun extends \yii\db\ActiveRecord
{

	
	public $nama_akun;
	public $debit;
	public $kredit;
    public $kode;
    public $kategori;
    public $keteranngan;

	public static function tableName()
	
	{
		return 'akun';

	}


	// public function rules()
	// {

	// return [
 //            [['id','notaris_id', 'akta_ppat_id','akta_notaris_id','akta_badan_id','akun_id'], 'required'],
 //            [['notaris_id', 'nominal','akun_id'], 'integer'],
 //            [['tanggal'], 'safe'],
 //            [['kategori'], 'string', 'max' => 45],           
 //            // [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
 //        ];
	// }


	public function attributesLabels()
	{
		 return [
            'id' => 'ID',
            'nama_akun' => 'Nama Akun',
            'debit' => 'Debit',
            'kredit' => 'kredit',
            'notaris_id' => 'Nama Notaris',
            'kode'=>'kode',
            'kategori' => 'Kategori Akun',
            'keterangan'=>'Deskripsi',           
        ];

	}


    

    public function dataKategoriAkun(){
        return[
            1=>'Kas & Bank',
            2=>'Aktiva Lancar'
        ];

    }

 //      public static function getOptions(){
 //        $data= 'biaya terkait akta';
       
 //        return $data;
 //    }

	// /**
 //     * @return \yii\db\ActiveQuery
 //     */
 //    public function getNotaris()
 //    {
 //        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
 //    }
    

	// /**
 //     * @return \yii\db\ActiveQuery
 //     */
 //    public function getAktaPPAT()
 //    {
 //        return $this->hasOne(AktaPpat::className(), ['id' => 'akta_ppat_id']);
 //    }
   

 //    /**
 //     * @return \yii\db\ActiveQuery
 //     */
 //    public function getAktaNotaris()
 //    {
 //        return $this->hasOne(AktaNotaris::className(), ['id' => 'akta_notaris_id']);
 //    }
    

 //    /**
 //     * @return \yii\db\ActiveQuery
 //     */
 //    public function getAktaBadan()
 //    {
 //        return $this->hasOne(AktaBadan::className(), ['id' => 'akta_badan_id']);
 //    }

    

 //    /**
 //     * @return \yii\db\ActiveQuery
 //     */
 //    public function getAkun()
 //    {
 //        return $this->hasOne(Akun::className(), ['id' => 'akun_id']);
 //    }
 //    public  function getNama()
 //    {
 //        return $this->akun->nama_kategori;
 //    }

   

}

 ?>