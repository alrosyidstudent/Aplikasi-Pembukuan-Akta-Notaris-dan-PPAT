<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemasukan_jenis".
 *
 * @property integer $id
 * @property integer $notaris_id
 * @property string $deskripsi
 * @property integer $nilai_standar
 *
 * @property Pemasukan[] $pemasukans
 * @property Notaris $notaris
 */
class PemasukanJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pemasukan_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notaris_id'], 'required'],
            [['id', 'notaris_id', 'nilai_standar'], 'integer'],
            [['deskripsi'], 'string', 'max' => 45],
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notaris_id' => 'Notaris ID',
            'deskripsi' => 'Deskripsi',
            'nilai_standar' => 'Nilai Standar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemasukans()
    {
        return $this->hasMany(Pemasukan::className(), ['pemasukan_jenis_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }
}
