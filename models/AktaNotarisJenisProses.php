<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_notaris_jenis_proses".
 *
 * @property integer $id
 * @property string $deskripsi
 * @property integer $notaris_id
 * @property integer $jangka_waktu
 * @property string $peringatkan
 * @property integer $akta_notaris_jenis_id
 *
 * @property AktaNotarisJenis $aktaNotarisJenis
 * @property Notaris $notaris
 * @property AktaNotarisProses[] $aktaNotarisProses
 */
class AktaNotarisJenisProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_notaris_jenis_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id', 'akta_notaris_jenis_id'], 'required'],
            [['notaris_id', 'jangka_waktu', 'akta_notaris_jenis_id'], 'integer'],
            [['deskripsi'], 'string', 'max' => 100],
            [['peringatkan'], 'string', 'max' => 5],
            [['akta_notaris_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaNotarisJenis::className(), 'targetAttribute' => ['akta_notaris_jenis_id' => 'id']],
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
            'deskripsi' => 'Deskripsi',
            'notaris_id' => 'Notaris ID',
            'jangka_waktu' => 'Jangka Waktu',
            'peringatkan' => 'Peringatkan',
            'akta_notaris_jenis_id' => 'Akta Notaris Jenis ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisJenis()
    {
        return $this->hasOne(AktaNotarisJenis::className(), ['id' => 'akta_notaris_jenis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisProses()
    {
        return $this->hasMany(AktaNotarisProses::className(), ['akta_notaris_jenis_proses_no' => 'id']);
    }

    public static function getOptions($akta_notaris_jenis_id){
        $data=  static::find()
            ->select(['id','deskripsi'])
            ->where(['akta_notaris_jenis_id'=>$akta_notaris_jenis_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','deskripsi');

        return $value;
    }
}
