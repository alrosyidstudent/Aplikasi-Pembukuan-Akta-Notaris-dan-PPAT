<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengda_lap".
 *
 * @property integer $id_pengda
 * @property integer $id_jenis_lap
 * @property string $format
 *
 * @property Pengda $idPengda
 * @property JenisLap $idJenisLap
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
            [['id_pengda'], 'exist', 'skipOnError' => true, 'targetClass' => Pengda::className(), 'targetAttribute' => ['id_pengda' => 'id']],
            [['id_jenis_lap'], 'exist', 'skipOnError' => true, 'targetClass' => JenisLap::className(), 'targetAttribute' => ['id_jenis_lap' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPengda()
    {
        return $this->hasOne(Pengda::className(), ['id' => 'id_pengda']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenisLap()
    {
        return $this->hasOne(JenisLap::className(), ['id' => 'id_jenis_lap']);
    }
}
