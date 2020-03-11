<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_notaris_jenis".
 *
 * @property integer $id
 * @property string $name
 * @property integer $notaris_id
 *
 * @property AktaNotaris[] $aktaNotaris
 * @property Notaris $notaris
 * @property AktaNotarisJenisProses[] $aktaNotarisJenisProses
 */
class AktaNotarisJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_notaris_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'notaris_id'], 'required'],
            [['notaris_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'name' => 'Nama',
            'notaris_id' => 'Notaris ID',
            'prosess' => 'Proses'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotaris()
    {
        return $this->hasMany(AktaNotaris::className(), ['akta_notaris_jenis_id' => 'id']);
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
    public function getAktaNotarisJenisProses()
    {
        return $this->hasMany(AktaNotarisJenisProses::className(), ['akta_notaris_jenis_id' => 'id']);
    }

    public static function getOptions(){
        $data=  static::find()->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }


    public function getProsess(){
        $proses_akta='';
        $a_prosess=AktaNotarisJenisProses::find()
            ->where(['akta_notaris_jenis_id'=>$this->id])->all();
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
}
