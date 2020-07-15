<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengda_lap".
 *
 * @property integer $id_pengda
 * @property integer $id_jenis_lap
 * @property string $format
 */
class PengdaLap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengda_lap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pengda', 'id_jenis_lap', 'format'], 'required'],
            [['id_pengda', 'id_jenis_lap'], 'integer'],
            [['format'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pengda' => 'Id Pengda',
            'id_jenis_lap' => 'Id Jenis Lap',
            'format' => 'Format',
        ];
    }
}
