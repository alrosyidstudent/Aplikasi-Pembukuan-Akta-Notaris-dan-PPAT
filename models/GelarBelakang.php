<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gelar_belakang".
 *
 * @property integer $id
 * @property string $singkatan
 * @property string $kepanjangan
 */
class GelarBelakang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gelar_belakang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['singkatan'], 'string', 'max' => 45],
            [['kepanjangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'singkatan' => 'Singkatan',
            'kepanjangan' => 'Kepanjangan',
        ];
    }
}
