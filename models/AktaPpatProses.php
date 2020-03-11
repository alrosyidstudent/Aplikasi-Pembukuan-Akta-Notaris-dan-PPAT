<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_ppat_proses".
 *
 * @property integer $akta_ppat_id
 * @property integer $akta_ppat_jenis_proses_id
 * @property string $keterangan
 * @property string $tanggal
 *
 * @property AktaPpat $aktaPpat
 * @property AktaPpatJenisProses $aktaPpatJenisProses
 */
class AktaPpatProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_ppat_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_ppat_id', 'akta_ppat_jenis_proses_id'], 'required'],
            [['akta_ppat_id', 'akta_ppat_jenis_proses_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string', 'max' => 100],
            [['akta_ppat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaPpat::className(), 'targetAttribute' => ['akta_ppat_id' => 'id']],
            [['akta_ppat_jenis_proses_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaPpatJenisProses::className(), 'targetAttribute' => ['akta_ppat_jenis_proses_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akta_ppat_id' => 'Akta Ppat ID',
            'akta_ppat_jenis_proses_id' => 'Akta Ppat Jenis Proses ID',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
        ];
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
    public function getAktaPpatJenisProses()
    {
        return $this->hasOne(AktaPpatJenisProses::className(), ['id' => 'akta_ppat_jenis_proses_id']);
    }
}
