<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_badan_jenis_sifat".
 *
 * @property integer $id
 * @property string $name
 * @property integer $akta_badan_jenis_id
 *
 * @property AktaBadanJenis $aktaBadanJenis
 */
class AktaBadanJenisSifat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_badan_jenis_sifat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_badan_jenis_id'], 'required'],
            [['akta_badan_jenis_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['akta_badan_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadanJenis::className(), 'targetAttribute' => ['akta_badan_jenis_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Sifat',
            'aktaBadanJenisName' => 'Jenis Akta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanJenis()
    {
        return $this->hasOne(AktaBadanJenis::className(), ['id' => 'akta_badan_jenis_id']);
    }

    public  function getAktaBadanJenisName()
    {
        return $this->aktaBadanJenis->name;
    }

    public function getProsess(){
        $proses_akta='';
        $a_prosess=AktaBadanJenisProses::find()
            ->where(['akta_badan_jenis_sifat_id'=>$this->id])->all();
        $n_prosess=count($a_prosess);
        $n=0;
        foreach ($a_prosess as $proses){
            $n++;
            $proses_akta=$proses_akta.' '.$proses->deskripsi;
            if($n!=$n_prosess){
                $proses_akta.=', ';
            }
        }
        return $proses_akta;
    }

    public static function getSifatByJenis($cat_id) {

        $data = static::find()
            ->where(['akta_badan_jenis_id'=>$cat_id])
            ->select(['id','name'])
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getSifatSelected($sifat_id) {
        $data = static::find()
            ->select(['id','name'])
            ->where(['id'=>$sifat_id])
            //->orderBy('nama')
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getSifatSelectedJenis($jenis_id) {
        $data =  static::find()
            ->where(['akta_badan_jenis_id'=>$jenis_id])
            //->orderBy('nama')
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }
}
