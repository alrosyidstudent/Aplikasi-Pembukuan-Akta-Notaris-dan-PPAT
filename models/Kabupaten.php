<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 *
 * @property integer $id
 * @property integer $provinsi_id
 * @property string $nama
 *
 * @property Provinsi $provinsi
 * @property Kecamatan[] $kecamatans
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kabupaten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinsi_id'], 'required'],
            [['provinsi_id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['provinsi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['provinsi_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provinsi_id' => 'Provinsi ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['id' => 'provinsi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatans()
    {
        return $this->hasMany(Kecamatan::className(), ['kabupaten_id' => 'id']);
    }

    public static function getOptions(){
        $data=  static::find()->orderBy('nama')->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','nama');

        return $value;
    }

    public static function getKabupatenByProvinsi($provinsi_id) {

        $data = static::find()
            ->select(['id','nama as name'])
            ->where(['provinsi_id'=>$provinsi_id])
            ->orderBy('nama')
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getKabupatenSelected($kabupaten_id) {
        $data = static::find()
            ->select(['id','nama as name'])
            ->where(['id'=>$kabupaten_id])
            ->orderBy('nama')
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getKabupatenSelectedProvinsi($provinsi_id) {
        $data =  static::find()
            ->where(['provinsi_id'=>$provinsi_id])
            ->orderBy('nama')->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','nama');

        return $value;
    }
}
