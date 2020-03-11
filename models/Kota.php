<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kota".
 *
 * @property integer $id
 * @property string $kota
 * @property integer $provinsi_id
 * @property string $pos
 *
 * @property Kecamatan[] $kecamatans
 * @property Provinsi $provinsi
 */
class Kota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinsi_id'], 'required'],
            [['provinsi_id'], 'integer'],
            [['kota'], 'string', 'max' => 100],
            [['pos'], 'string', 'max' => 10],
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
            'kota' => 'Kota',
            'provinsi_id' => 'Provinsi ID',
            'pos' => 'Pos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatans()
    {
        return $this->hasMany(Kecamatan::className(), ['kota_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['id' => 'provinsi_id']);
    }

    public static function getOptions(){
        $data=  static::find()->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','kota as name');

        return $value;
    }

    public static function getKotaByProvinsi($provinsi_id) {

        $data = static::find()
            ->where(['provinsi_id'=>$provinsi_id])
            ->select(['id','kota as name'])
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
}
