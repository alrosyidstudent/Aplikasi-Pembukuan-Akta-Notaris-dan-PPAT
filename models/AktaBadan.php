<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_badan".
 *
 * @property integer $id
 * @property integer $notaris_id
 * @property integer $nomor
 * @property string $tanggal
 * @property string $nama
 * @property integer $kelurahan_id
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property integer $corporate_client_id
 * @property string $register
 * @property integer $akta_badan_jenis_id
 * @property integer $akta_badan_jenis_sifat_id
 *
 * @property AktaBadanJenis $aktaBadanJenis
 * @property AktaBadanJenisSifat $aktaBadanJenisSifat
 * @property CorporateClient $corporateClient
 * @property Kelurahan $kelurahan
 * @property Notaris $notaris
 * @property AktaBadanPihak[] $aktaBadanPihaks
 * @property AktaBadanProses[] $aktaBadanProses
 */
class AktaBadan extends \yii\db\ActiveRecord
{
    public $provinsi_id;
    public $kabupaten_id;
    public $kecamatan_id;
    //public $kedudukan;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_badan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id', 'akta_badan_jenis_id', 'akta_badan_jenis_sifat_id','user_id'], 'required'],
            [['notaris_id', 'kelurahan_id', 'corporate_client_id', 'akta_badan_jenis_id', 'akta_badan_jenis_sifat_id','user_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['nama'], 'string', 'max' => 70],
            [['nomor'], 'string', 'max' => 45],
            [['alamat'], 'string', 'max' => 100],
            [['rt', 'rw'], 'string', 'max' => 5],
            [['dusun', 'register'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['akta_badan_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadanJenis::className(), 'targetAttribute' => ['akta_badan_jenis_id' => 'id']],
            [['akta_badan_jenis_sifat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadanJenisSifat::className(), 'targetAttribute' => ['akta_badan_jenis_sifat_id' => 'id']],
            [['corporate_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => CorporateClient::className(), 'targetAttribute' => ['corporate_client_id' => 'id']],
            [['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
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
            'kelurahan_id' => 'Kelurahan',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'dusun' => 'Dusun',
            'corporate_client_id' => 'Corporate Client',
            'register' => 'Register',
            'akta_badan_jenis_id' => 'Jenis Akta',
            'akta_badan_jenis_sifat_id' => 'Sifat Akta',
            'provinsi_id'=>'Provinsi',
            'kabupaten_id'=>'Kota/Kabupaten',
            'kecamatan_id' => 'Kecamatan',
            'user_id' => 'PIC',
            'penanggungjawab' => 'PIC',
            'clientName' => 'Client'

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanJenis()
    {
        return $this->hasOne(AktaBadanJenis::className(), ['id' => 'akta_badan_jenis_id']);
    }
    public  function getJenis()
    {
        return $this->aktaBadanJenis->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanJenisSifat()
    {
        return $this->hasOne(AktaBadanJenisSifat::className(), ['id' => 'akta_badan_jenis_sifat_id']);
    }
    public  function getSifat()
    {
        return $this->aktaBadanJenisSifat->name;
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
    public function getAktaBadanPihaks()
    {
        return $this->hasMany(AktaBadanPihak::className(), ['akta_badan_id' => 'id', 'akta_badan_akta_badan_jenis_id' => 'akta_badan_jenis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanProses()
    {
        return $this->hasMany(AktaBadanProses::className(), ['akta_badan_id' => 'id', 'akta_badan_akta_badan_jenis_id' => 'akta_badan_jenis_id']);
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

    /*public function getKedudukan(){
        $kedudukan='';
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
        return $kedudukan;
    }*/
}
