<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "surat_bawah_tangan".
 *
 * @property integer $id
 * @property string $nomor_urut
 * @property string $tanggal
 * @property string $jenis
 * @property integer $notaris_id
 * @property integer $surat_sifat_id
 *
 * @property SuratSifat $suratSifat
 * @property Notaris $notaris
 * @property SuratBawahTanganPihak[] $suratBawahTanganPihaks
 */
class SuratBawahTangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surat_bawah_tangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['notaris_id', 'surat_sifat_id','jenis'], 'required'],
            [['notaris_id', 'surat_sifat_id'], 'integer'],
            [['nomor_urut', 'jenis'], 'string', 'max' => 45],
            [['surat_sifat_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuratSifat::className(), 'targetAttribute' => ['surat_sifat_id' => 'id']],
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_urut' => 'Nomor Urut',
            'tanggal' => 'Tanggal',
            'jenis' => 'Jenis',
            'notaris_id' => 'Notaris',
            'surat_sifat_id' => 'Sifat Surat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratSifat()
    {
        return $this->hasOne(SuratSifat::className(), ['id' => 'surat_sifat_id']);
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
    public function getSuratBawahTanganPihaks()
    {
        return $this->hasMany(SuratBawahTanganPihak::className(), ['surat_bawah_tangan_id' => 'id']);
    }
}
