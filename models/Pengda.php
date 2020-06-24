<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengda".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $id_kab
 *
 * @property Kabupaten $idKab
 * @property PengdaLap[] $pengdaLaps
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
            [['id', 'nama', 'id_kab'], 'required'],
            [['id', 'id_kab'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['id_kab'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['id_kab' => 'id']],
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
            'id_kab' => 'Id Kab',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdKab()
    {
        return $this->hasOne(Kabupaten::className(), ['id' => 'id_kab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengdaLaps()
    {
        return $this->hasMany(PengdaLap::className(), ['id_pengda' => 'id']);
    }
}
