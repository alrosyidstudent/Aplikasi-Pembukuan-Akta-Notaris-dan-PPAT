<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi".
 *
 * @property integer $id
 * @property string $jenis
 * @property integer $nominal
 * @property string $tanggal
 * @property string $keterangan
 * @property integer $notaris_id
 * @property integer $akta_ppat_id
 * @property integer $akta_notaris_id
 * @property integer $akta_badan_id
 * @property integer $kategori_akun_id
 * @property string $register
 *
 * @property Notaris $notaris
 * @property AktaPpat $aktaPpat
 * @property AktaNotaris $aktaNotaris
 * @property AktaBadan $aktaBadan
 * @property KategoriAkun $kategoriAkun
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis', 'nominal', 'tanggal', 'keterangan', 'notaris_id', 'kategori_akun_id'], 'required'],
            [['nominal', 'notaris_id', 'akta_ppat_id', 'akta_notaris_id', 'akta_badan_id', 'kategori_akun_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['jenis'], 'string', 'max' => 45],
            [['keterangan'], 'string', 'max' => 100],
            
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
            [['akta_ppat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaPpat::className(), 'targetAttribute' => ['akta_ppat_id' => 'id']],
            [['akta_notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaNotaris::className(), 'targetAttribute' => ['akta_notaris_id' => 'id']],
            [['akta_badan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadan::className(), 'targetAttribute' => ['akta_badan_id' => 'id']],
            [['kategori_akun_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriAkun::className(), 'targetAttribute' => ['kategori_akun_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
            'nominal' => 'Nominal',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
            'notaris_id' => 'Notaris ID',
            'akta_ppat_id' => 'Akta Ppat ID',
            'akta_notaris_id' => 'Akta Notaris ID',
            'akta_badan_id' => 'Akta Badan ID',
            'kategori_akun_id' => 'Kategori Akun',
            
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
    public function getAktaPpat()
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
