<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akun".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $debit
 * @property integer $kredit
 * @property string $tanggal
 * @property integer $notaris_id
 * @property integer $kategori_akun_id
 * @property string $ket
 *
 * @property Notaris $notaris
 * @property KategoriAkun $kategoriAkun
 */
class Neraca extends \yii\db\ActiveRecord
{

      public $tanggalperiodeawal;
      public $tanggalperiodeakhir;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'tanggal', 'notaris_id', 'kategori_akun_id', 'ket'], 'required'],
            [['debit', 'kredit', 'notaris_id', 'kategori_akun_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['nama'], 'string', 'max' => 45],
            [['ket'], 'string', 'max' => 100],
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
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
            'nama' => 'Nama',
            'debit' => 'Debit',
            'kredit' => 'Kredit',
            'tanggal' => 'Tanggal',
            'notaris_id' => 'Notaris',
            'kategori_akun_id' => 'Kategori Akun',
            'ket' => 'Ket',
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
}
