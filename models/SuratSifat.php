<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "surat_sifat".
 *
 * @property integer $id
 * @property string $name
 * @property integer $notaris_id
 *
 * @property SuratBawahTangan[] $suratBawahTangans
 * @property Notaris $notaris
 */
class SuratSifat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surat_sifat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'notaris_id'], 'required'],
            [['notaris_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'name' => 'Sifat Surat',
            'notaris_id' => 'Notaris ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratBawahTangans()
    {
        return $this->hasMany(SuratBawahTangan::className(), ['surat_sifat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }
}
