<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "surat_bawah_tangan_pihak".
 *
 * @property integer $id
 * @property integer $surat_bawah_tangan_id
 * @property string $selaku
 * @property string $nama
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property integer $kelurahan_id
 *
 * @property Kelurahan $kelurahan
 * @property SuratBawahTangan $suratBawahTangan
 */
class SuratBawahTanganPihak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surat_bawah_tangan_pihak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surat_bawah_tangan_id', 'kelurahan_id'], 'required'],
            [['surat_bawah_tangan_id', 'kelurahan_id'], 'integer'],
            [['selaku', 'nama'], 'string', 'max' => 60],
            [['alamat'], 'string', 'max' => 100],
            [['rt', 'rw'], 'string', 'max' => 5],
            [['dusun'], 'string', 'max' => 45],
            [['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
            [['surat_bawah_tangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuratBawahTangan::className(), 'targetAttribute' => ['surat_bawah_tangan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surat_bawah_tangan_id' => 'Surat Bawah Tangan ID',
            'selaku' => 'Selaku',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'dusun' => 'Dusun',
            'kelurahan_id' => 'Kelurahan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id' => 'kelurahan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratBawahTangan()
    {
        return $this->hasOne(SuratBawahTangan::className(), ['id' => 'surat_bawah_tangan_id']);
    }
}
