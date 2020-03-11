<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_notaris".
 *
 * @property integer $id
 * @property integer $notaris_id
 * @property integer $nomor
 * @property string $tanggal
 * @property string $nama
 * @property integer $akta_notaris_jenis_id
 * @property string $register
 * @property integer $corporate_client_id
 * @property integer $user_id
 *
 * @property AktaNotarisJenis $aktaNotarisJenis
 * @property CorporateClient $corporateClient
 * @property User $user
 * @property Notaris $notaris
 * @property AktaNotarisPihak[] $aktaNotarisPihaks
 * @property AktaNotarisProses[] $aktaNotarisProses
 */
class AktaNotaris extends \yii\db\ActiveRecord
{
    public $provinsi_id;
    public $kabupaten_id;
    public $kecamatan_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_notaris';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id', 'akta_notaris_jenis_id'], 'required'],
            [['notaris_id', 'nomor', 'akta_notaris_jenis_id', 'corporate_client_id', 'user_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['nama'], 'string', 'max' => 70],
            [['register'], 'string', 'max' => 25],
            [['akta_notaris_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaNotarisJenis::className(), 'targetAttribute' => ['akta_notaris_jenis_id' => 'id']],
            [['corporate_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => CorporateClient::className(), 'targetAttribute' => ['corporate_client_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'notaris_id' => 'Notaris ID',
            'nomor' => 'Nomor',
            'tanggal' => 'Tanggal',
            'nama' => 'Nama',
            'akta_notaris_jenis_id' => 'Jenis Akta',
            'register' => 'Register',
            'corporate_client_id' => 'Client',
            'user_id' => 'PIC',
            'clientName' => 'Client'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisJenis()
    {
        return $this->hasOne(AktaNotarisJenis::className(), ['id' => 'akta_notaris_jenis_id']);
    }
    public  function getJenis()
    {
        return $this->aktaNotarisJenis->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateClient()
    {
        return $this->hasOne(CorporateClient::className(), ['id' => 'corporate_client_id']);
    }
    public  function getClientName()
    {
        if($this->corporateClient=='')
        {
            return '-';
        }else{
            //return 'ok';
            return $this->corporateClient->nama;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public  function getPic()
    {
        $staff=DetilUser::find()->where(['user_id'=>$this->user_id])->asArray()->one();
        return $staff['nama'];
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
    public function getAktaNotarisPihaks()
    {
        return $this->hasMany(AktaNotarisPihak::className(), ['akta_notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisProses()
    {
        return $this->hasMany(AktaNotarisProses::className(), ['akta_notaris_id' => 'id']);
    }
}
