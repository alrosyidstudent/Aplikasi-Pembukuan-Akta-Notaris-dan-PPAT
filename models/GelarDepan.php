<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gelar_depan".
 *
 * @property integer $id
 * @property string $singkatan
 * @property string $kepanjangan
 */
class GelarDepan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gelar_depan';
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
