<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_badan_pihak".
 *
 * @property integer $id
 * @property string $selaku
 * @property string $nama
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property integer $kelurahan_id
 * @property string $npwp
 * @property string $nik
 * @property integer $akta_badan_id
 * @property integer $akta_badan_akta_badan_jenis_id
 *
 * @property AktaBadan $aktaBadan
 * @property Kelurahan $kelurahan
 */
class AktaBadanPihak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_badan_pihak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelurahan_id', 'akta_badan_id', 'akta_badan_akta_badan_jenis_id'], 'required'],
            [['kelurahan_id', 'akta_badan_id', 'akta_badan_akta_badan_jenis_id'], 'integer'],
            [['selaku', 'nama'], 'string', 'max' => 60],
            [['alamat'], 'string', 'max' => 100],
            [['rt', 'rw'], 'string', 'max' => 5],
            [['dusun', 'npwp', 'nik'], 'string', 'max' => 45],
            [['akta_badan_id', 'akta_badan_akta_badan_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadan::className(), 'targetAttribute' => ['akta_badan_id' => 'id', 'akta_badan_akta_badan_jenis_id' => 'akta_badan_jenis_id']],
            [['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'selaku' => 'Selaku',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'dusun' => 'Dusun',
            'kelurahan_id' => 'Kelurahan ID',
            'npwp' => 'Npwp',
            'nik' => 'Nik',
            'akta_badan_id' => 'Akta Badan ID',
            'akta_badan_akta_badan_jenis_id' => 'Akta Badan Akta Badan Jenis ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadan()
    {
        return $this->hasOne(AktaBadan::className(), ['id' => 'akta_badan_id', 'akta_badan_jenis_id' => 'akta_badan_akta_badan_jenis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id' => 'kelurahan_id']);
    }
}
