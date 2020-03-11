<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_badan_proses".
 *
 * @property integer $akta_badan_jenis_proses_id
 * @property integer $akta_badan_id
 * @property string $keterangan
 * @property string $tanggal
 *
 * @property AktaBadan $aktaBadan
 * @property AktaBadanJenisProses $aktaBadanJenisProses
 */
class AktaBadanProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_badan_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_badan_jenis_proses_id', 'akta_badan_id'], 'required'],
            [['akta_badan_jenis_proses_id', 'akta_badan_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string', 'max' => 100],
            [['akta_badan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadan::className(), 'targetAttribute' => ['akta_badan_id' => 'id']],
            [['akta_badan_jenis_proses_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadanJenisProses::className(), 'targetAttribute' => ['akta_badan_jenis_proses_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akta_badan_jenis_proses_id' => 'Akta Badan Jenis Proses ID',
            'akta_badan_id' => 'Akta Badan ID',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
        ];
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
    public function getAktaBadanJenisProses()
    {
        return $this->hasOne(AktaBadanJenisProses::className(), ['id' => 'akta_badan_jenis_proses_id']);
    }
}
