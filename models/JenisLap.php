<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_lap".
 *
 * @property integer $id
 * @property string $nama
 * @property string $format
 * @property integer $pengda_id
 *
 * @property Pengda $pengda
 */
class JenisLap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenis_lap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'format', 'pengda_id'], 'required'],
            [['pengda_id'], 'integer'],
            [['nama', 'format'], 'string', 'max' => 100],
            [['pengda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pengda::className(), 'targetAttribute' => ['pengda_id' => 'id']],
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
            'format' => 'Format',
            'pengda_id' => 'Pengawas Daerah',
            'pengdaName' => 'Nama Pengawas Daerah',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengda()
    {
        return $this->hasOne(Pengda::className(), ['id' => 'pengda_id']);
    }

    public function getPengdaName()
    {
        return $this->pengda->nama;
    }
}
