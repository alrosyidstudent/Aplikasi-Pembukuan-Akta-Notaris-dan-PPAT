<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "akta_badan_jenis".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AktaBadan[] $aktaBadans
 * @property AktaBadanJenisProses[] $aktaBadanJenisProses
 * @property AktaBadanJenisSifat[] $aktaBadanJenisSifats
 */
class AktaBadanJenis extends \yii\db\ActiveRecord
{
    public $sifatName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_badan_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'sifats' => 'Sifat akta',
            'prosess' => 'Tahapan'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadans()
    {
        return $this->hasMany(AktaBadan::className(), ['akta_badan_jenis_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanJenisProses()
    {
        return $this->hasMany(AktaBadanJenisProses::className(), ['akta_badan_jenis_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanJenisSifats()
    {
        return $this->hasMany(AktaBadanJenisSifat::className(), ['akta_badan_jenis_id' => 'id']);
    }

    /*public function getSifats(){
        $sifat_akta='';
        $a_sifats=AktaBadanJenisSifat::find()
            ->where(['akta_badan_jenis_id'=>$this->id])->all();
        $n_sifats=count($a_sifats);
        $n=0;
        foreach ($a_sifats as $sifat){
            $n++;
            $sifat_akta=$sifat_akta.' '.Html::a($sifat->name, ['site/index']);
            if($n!=$n_sifats){
                $sifat_akta.=', ';
            }
        }
        return $sifat_akta;
    }*/

    /*public function getProsess(){
        $proses_akta='';
        $a_prosess=AktaBadanJenisProses::find()
            ->where(['akta_badan_jenis_id'=>$this->id])->all();
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
    }*/

    public static function getOptions(){
        $data=  static::find()->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }

}
