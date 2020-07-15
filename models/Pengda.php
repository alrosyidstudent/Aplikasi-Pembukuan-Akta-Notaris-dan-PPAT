<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengda".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $kabupaten_id
 *
 * @property JenisLap[] $jenisLaps
 * @property Kabupaten $kabupaten
 */
class Pengda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'kabupaten_id'], 'required'],
            [['kabupaten_id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['kabupaten_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['kabupaten_id' => 'id']],
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
            'kabupaten_id' => 'Kabupaten',
            'kabupatenName' => 'Kabupaten',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisLaps()
    {
        return $this->hasMany(JenisLap::className(), ['pengda_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['id' => 'kabupaten_id']);
    }

    public function getKabupatenName()
    {
        return $this->kabupaten->nama;
    }

    public static function getOptions()
    {
        $data=  static::find()->orderBy('nama')->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','kabupatenName');

        return $value;
    }
}
