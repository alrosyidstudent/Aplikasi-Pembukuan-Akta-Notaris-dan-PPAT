<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_notaris_proses".
 *
 * @property integer $akta_notaris_jenis_proses_id
 * @property integer $akta_notaris_id
 * @property string $keterangan
 * @property string $tanggal
 *
 * @property AktaNotaris $aktaNotaris
 * @property AktaNotarisJenisProses $aktaNotarisJenisProses
 */
class AktaNotarisProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_notaris_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_notaris_jenis_proses_id', 'akta_notaris_id'], 'required'],
            [['akta_notaris_jenis_proses_id', 'akta_notaris_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string', 'max' => 100],
            [['akta_notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaNotaris::className(), 'targetAttribute' => ['akta_notaris_id' => 'id']],
            [['akta_notaris_jenis_proses_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaNotarisJenisProses::className(), 'targetAttribute' => ['akta_notaris_jenis_proses_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akta_notaris_jenis_proses_id' => 'Status/Proses',
            'akta_notaris_id' => 'Akta Notaris ID',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotaris()
    {
        return $this->hasOne(AktaNotaris::className(), ['id' => 'akta_notaris_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisJenisProses()
    {
        return $this->hasOne(AktaNotarisJenisProses::className(), ['id' => 'akta_notaris_jenis_proses_id']);
    }
    public static function getOptions(){
        $data=  static::find()
            ->select(['id','deskripsi'])
            ->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','deskripsi');

        return $value;
    }
}
