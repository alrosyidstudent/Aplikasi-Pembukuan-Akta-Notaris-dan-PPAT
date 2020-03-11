<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengeluaran".
 *
 * @property integer $id
 * @property string $tanggal
 * @property integer $nominal
 * @property string $keterangan
 * @property integer $pengeluaran_jenis_id
 *
 * @property PengeluaranJenis $pengeluaranJenis
 */
class Pengeluaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengeluaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['nominal', 'pengeluaran_jenis_id'], 'integer'],
            [['pengeluaran_jenis_id'], 'required'],
            [['keterangan'], 'string', 'max' => 45],
            [['pengeluaran_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => PengeluaranJenis::className(), 'targetAttribute' => ['pengeluaran_jenis_id' => 'id']],
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
            'pengeluaran_jenis_id' => 'Pengeluaran Jenis ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengeluaranJenis()
    {
        return $this->hasOne(PengeluaranJenis::className(), ['id' => 'pengeluaran_jenis_id']);
    }
}
