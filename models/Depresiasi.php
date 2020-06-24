<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "depresiasi".
 *
 * @property integer $id
 * @property integer $nominal
 * @property string $keterangan
 * @property integer $akun_id
 * @property integer $notaris_id
 *
 * @property Akun $akun
 * @property Notaris $notaris
 */
class Depresiasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'depresiasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nominal', 'keterangan', 'akun_id', 'notaris_id'], 'required'],
            [['nominal', 'akun_id', 'notaris_id'], 'integer'],
            [['keterangan'], 'string', 'max' => 255],
            [['akun_id'], 'exist', 'skipOnError' => true, 'targetClass' => Akun::className(), 'targetAttribute' => ['akun_id' => 'id']],
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
            'nominal' => 'Nominal',
            'keterangan' => 'Keterangan',
            'akun_id' => 'Akun',
            'notaris_id' => 'Notaris ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkun()
    {
        return $this->hasOne(Akun::className(), ['id' => 'akun_id']);
    }
    public  function AkunNama()
    {
        return $this->AkunNama->nama;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }
}
