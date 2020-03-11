<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemasukan".
 *
 * @property integer $id
 * @property string $tanggal
 * @property integer $nominal
 * @property string $keterangan
 * @property integer $pemasukan_jenis_id
 *
 * @property PemasukanJenis $pemasukanJenis
 */
class Pemasukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pemasukan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['nominal', 'pemasukan_jenis_id'], 'integer'],
            [['pemasukan_jenis_id'], 'required'],
            [['keterangan'], 'string', 'max' => 45],
            [['pemasukan_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => PemasukanJenis::className(), 'targetAttribute' => ['pemasukan_jenis_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'nominal' => 'Nominal',
            'keterangan' => 'Keterangan',
            'pemasukan_jenis_id' => 'Pemasukan Jenis ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemasukanJenis()
    {
        return $this->hasOne(PemasukanJenis::className(), ['id' => 'pemasukan_jenis_id']);
    }
}
