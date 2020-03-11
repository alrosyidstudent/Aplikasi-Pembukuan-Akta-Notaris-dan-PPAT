<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "corporate_client".
 *
 * @property integer $id
 * @property integer $notaris_id
 * @property integer $user_id
 * @property string $nama
 * @property string $alamat
 *
 * @property AktaNotaris[] $aktaNotaris
 * @property AktaPpat[] $aktaPpats
 * @property Notaris $notaris
 * @property User $user
 */
class CorporateClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'corporate_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id', 'user_id'], 'required'],
            [['notaris_id', 'user_id'], 'integer'],
            [['nama', 'alamat'], 'string', 'max' => 100],
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public  function getUserName()
    {
        return $this->user->userName;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            //'notaris_id' => 'Notaris ID',
            //'user_id' => 'User ID',
            'user_name' => 'User Name',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotaris()
    {
        return $this->hasMany(AktaNotaris::className(), ['corporate_client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpats()
    {
        return $this->hasMany(AktaPpat::className(), ['corporate_client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }

    public static function getOptions(){
        $data=  static::find()
            ->select(['id','nama'])
            ->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','nama');

        return $value;
    }


}
