<?php 

namespace app\models;

use Yii;

use yii\db\ActiveRecord;

class Akun extends \yii\db\ActiveRecord{

	public static function tableName()
	
	{
		return 'akun';

	}


	public function rules()
    {

	return [
            [['id','notaris_id','kategori_akun_id'], 'required'],
            [['notaris_id', 'kredit','debit','kategori_akun_id'], 'integer'],             
            [['nama'], 'string', 'max' => 45],  
            [['ket'], 'string', 'max' => 200],         
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
            [['kategori_akun_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriAkun::className(), 'targetAttribute' => ['kategori_akun_id' => 'id']]
        ];
	}


	public function attributesLabels()
	{
		 return [
            'id' => 'ID',
            'nama' => 'Nama Akun',
            'debit' => 'Debit',
            'kredit' => 'kredit',
            'notaris_id' => 'Nama Notaris',
            'kategori_akun_id' => 'Kategori Akun',
            'ket'=>'Keterangan Akun'       
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