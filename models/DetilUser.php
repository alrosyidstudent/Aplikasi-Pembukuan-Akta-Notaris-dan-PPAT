<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detil_user".
 *
 * @property integer $id
 * @property integer $notaris_id
 * @property integer $user_id
 * @property string $nama
 * @property string $detil_usercol
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $desa_kel
 * @property integer $kelurahan_id
 *
 * @property Kelurahan $kelurahan
 * @property Notaris $notaris
 * @property User $user
 */
class DetilUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detil_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id', 'user_id'], 'required'],
            [['notaris_id', 'user_id', 'kelurahan_id'], 'integer'],
            [['nama', 'alamat'], 'string', 'max' => 100],
            [['desa_kel'], 'string', 'max' => 45],
            [['rt', 'rw'], 'string', 'max' => 5],
            //[['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notaris_id' => 'Notaris ID',
            'user_id' => 'User ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'desa_kel' => 'Desa Kel',
            'kelurahan_id' => 'Kelurahan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id' => 'kelurahan_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getOptions(){
        $data=  static::find()
            ->select(['user_id as id','nama'])
            ->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','nama');

        return $value;
    }
}
