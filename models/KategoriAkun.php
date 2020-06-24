<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "kategori_akun".
 *
 * @property integer $id
 * @property string $name
 * @property integer $notaris_id
 *
 * @property Akun[] $akuns
 * @property Notaris $notaris
 * @property Transaksi[] $transaksis
 */
class KategoriAkun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_akun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['name'], 'string', 'max' => 45],
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
            'name' => 'Kategori Akun',
           
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkuns()
    {
        return $this->hasMany(Akun::className(), ['kategori_akun_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['kategori_akun_id' => 'id']);
    }

    //menampilkan data kategori akun untuk Akun ke dropdown
    public static function getOptionsAkun(){
        $data=  static::find()
            ->select(['id','name'])
            // ->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->andwhere(['between','id','33','41'])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }

    //menampilkan data kategori akun untuk Transaksi ke dropdown
    public static function getOptionsTransaksi(){
        $data=  static::find()
            ->select(['id','name'])
            // ->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->andwhere(['between','id','42','45'])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }
}
