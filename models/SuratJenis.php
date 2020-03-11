<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "surat_jenis".
 *
 * @property integer $id
 * @property string $name
 *
 * @property SuratBawahTangan[] $suratBawahTangans
 */
class SuratJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surat_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratBawahTangans()
    {
        return $this->hasMany(SuratBawahTangan::className(), ['surat_jenis_id' => 'id']);
    }
}
