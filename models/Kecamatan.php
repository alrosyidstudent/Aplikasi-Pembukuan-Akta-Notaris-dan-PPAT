<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kecamatan".
 *
 * @property integer $id
 * @property integer $kabupaten_id
 * @property string $nama
 *
 * @property Kabupaten $kabupaten
 * @property Kelurahan[] $kelurahans
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kecamatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kabupaten_id'], 'required'],
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
            'kabupaten_id' => 'Kabupaten ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['id' => 'kabupaten_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahans()
    {
        return $this->hasMany(Kelurahan::className(), ['kecamatan_id' => 'id']);
    }

    public static function getKecamatanByKabupaten($kabupaten_id) {

        $data = static::find()
            ->select(['id','nama as name'])
            ->where(['kabupaten_id'=>$kabupaten_id])
            ->orderBy('nama')
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getKecamatanSelected($kecamatan_id) {
        $data = static::find()
            ->select(['id','nama as name'])
            ->where(['id'=>$kecamatan_id])
            ->orderBy('nama')
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getKecamatanSelectedKabupaten($kabupaten_id) {
        $data =  static::find()
            ->where(['kabupaten_id'=>$kabupaten_id])
            ->orderBy('nama')->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','nama');

        return $value;
    }
}
