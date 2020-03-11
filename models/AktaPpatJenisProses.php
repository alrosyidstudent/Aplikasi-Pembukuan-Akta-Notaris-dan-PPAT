<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_ppat_jenis_proses".
 *
 * @property integer $id
 * @property string $deskripsi
 * @property integer $notaris_id
 * @property integer $jangka_waktu
 * @property string $peringatkan
 * @property integer $akta_ppat_jenis_id
 *
 * @property AktaPpatJenis $aktaPpatJenis
 * @property Notaris $notaris
 * @property AktaPpatProses[] $aktaPpatProses
 * @property AktaPpat[] $aktaPpats
 */
class AktaPpatJenisProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_ppat_jenis_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id', 'akta_ppat_jenis_id'], 'required'],
            [['notaris_id', 'jangka_waktu', 'akta_ppat_jenis_id'], 'integer'],
            [['deskripsi'], 'string', 'max' => 100],
            [['peringatkan'], 'string', 'max' => 5],
            [['akta_ppat_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaPpatJenis::className(), 'targetAttribute' => ['akta_ppat_jenis_id' => 'id']],
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
            'akta_ppat_jenis_id' => 'Akta Ppat Jenis ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatJenis()
    {
        return $this->hasOne(AktaPpatJenis::className(), ['id' => 'akta_ppat_jenis_id']);
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
    public function getAktaPpatProses()
    {
        return $this->hasMany(AktaPpatProses::className(), ['akta_ppat_jenis_proses_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpats()
    {
        return $this->hasMany(AktaPpat::className(), ['id' => 'akta_ppat_id'])->viaTable('akta_ppat_proses', ['akta_ppat_jenis_proses_id' => 'id']);
    }

    public static function getOptions($akta_ppat_jenis_id){
        $data=  static::find()
            ->select(['id','deskripsi'])
            ->where(['akta_ppat_jenis_id'=>$akta_ppat_jenis_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','deskripsi');

        return $value;
    }
}
