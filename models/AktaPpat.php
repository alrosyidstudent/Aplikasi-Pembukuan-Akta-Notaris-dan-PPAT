<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_ppat".
 *
 * @property integer $id
 * @property integer $notaris_id
 * @property string $nomor
 * @property integer $akta_ppat_jenis_id
 * @property string $no_objek
 * @property integer $kelurahan_id
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property integer $corporate_client_id
 * @property string $register
 * @property integer $user_id
 * @property integer $luas_tanah
 * @property integer $luas_bangunan
 * @property integer $nilai_pengalihan
 * @property string $nop
 * @property integer $njop_tanah
 * @property integer $njop_bangunan
 * @property string $ssp_tanggal
 * @property integer $ssp_nilai
 * @property string $sspd_tanggal
 * @property integer $sspd_nilai
 *
 * @property AktaPpatJenis $aktaPpatJenis
 * @property CorporateClient $corporateClient
 * @property Kelurahan $kelurahan
 * @property Notaris $notaris
 * @property User $user
 * @property AktaPpatPenerima[] $aktaPpatPenerimas
 * @property AktaPpatPengalih[] $aktaPpatPengalihs
 * @property AktaPpatProses[] $aktaPpatProses
 * @property AktaPpatJenisProses[] $aktaPpatJenisProses
 */
class AktaPpat extends \yii\db\ActiveRecord
{
    public $provinsi_id;
    public $kabupaten_id;
    public $kecamatan_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_ppat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id', 'akta_ppat_jenis_id', 'kelurahan_id', 'user_id'], 'required'],
            [['notaris_id', 'akta_ppat_jenis_id', 'kelurahan_id', 'corporate_client_id', 'user_id', 'luas_tanah', 'luas_bangunan', 'ssp_nilai', 'sspd_nilai'], 'integer'],
            [['ssp_tanggal', 'sspd_tanggal', 'tanggal'], 'safe'],
            [['nomor', 'dusun', 'nop'], 'string', 'max' => 45],
            [['alamat'], 'string', 'max' => 100],
            [['rt', 'rw'], 'string', 'max' => 5],
            [['register'], 'string', 'max' => 25],
            [['akta_ppat_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaPpatJenis::className(), 'targetAttribute' => ['akta_ppat_jenis_id' => 'id']],
            [['corporate_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => CorporateClient::className(), 'targetAttribute' => ['corporate_client_id' => 'id']],
            [['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
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
            'nomor' => 'Nomor',
            'tanggal' => 'Tanggal',
            'akta_ppat_jenis_id' => 'Jenis Akta',
            'alamat' => 'Akta PPAT (Alamat)',
            'rt' => 'RT',
            'rw' => 'RW',
            'dusun' => 'Dusun',
            'corporate_client_id' => 'Corporate Client',
            'register' => 'Register',
            'user_id' => 'PIC',
            'luas_tanah' => 'Luas Tanah',
            'luas_bangunan' => 'Luas Bangunan',
            'nilai_pengalihan' => 'Nilai Pengalihan',
            'nop' => 'NOP',
            'njop_tanah' => 'NJOP Tanah',
            'njop_bangunan' => 'NJOP Bangunan',
            'ssp_tanggal' => 'SSP Tanggal',
            'ssp_nilai' => 'SSP Nilai',
            'sspd_tanggal' => 'SSPD Tanggal',
            'sspd_nilai' => 'SSPD Nilai',
            'provinsi_id' => 'Provinsi',
            'kabupaten_id' => 'Kota/Kabupaten',
            'kecamatan_id' => 'Kecamatan',
            'clientName' => 'Client',
            'pic' => 'PIC',
            'kelurahan_id' => 'Kelurahan',
            'kelurahanName' => 'Kelurahan',
            'kecamatan_id' => 'Kecamatan',
            'kecamatanName'=>'Kecamatan',
            'kabupaten_id' => 'Kabupaten',
            'kabupatenName'=>'Kabupaten',
            'provinsi_id' => 'Provinsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatJenis()
    {
        return $this->hasOne(AktaPpatJenis::className(), ['id' => 'akta_ppat_jenis_id']);
    }

    public function getJenis()
    {
        return $this->aktaPpatJenis->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateClient()
    {
        return $this->hasOne(CorporateClient::className(), ['id' => 'corporate_client_id']);
    }

    public function getClientName()
    {
        if ($this->corporateClient == '') {
            return '-';
        } else {
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

    public function getKelurahanName()
    {
        return $this->kelurahan->nama;
    }

    public function getKecamatanName()
    {
        return $this->kelurahan->kecamatanName;

    }
    public function getKabupatenName()
    {
        return $this->kelurahan->kabupatenName;
    }
    public function getProvinsiName()
    {
        return $this->kelurahan->provinsiName;
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

    public function getPic()
    {
        $staff = DetilUser::find()->where(['user_id' => $this->user_id])->asArray()->one();
        return $staff['nama'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatPihaks()
    {
        return $this->hasMany(AktaPpatPihak::className(), ['akta_ppat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatProses()
    {
        return $this->hasMany(AktaPpatProses::className(), ['akta_ppat_id' => 'id']);
    }

    public function getStatus()
    {
        $status = AktaPpatProses::find()
            ->select(['akta_ppat_jenis_proses.deskripsi as desk'])
            ->rightJoin('akta_ppat_jenis_proses', 'akta_ppat_proses.akta_ppat_jenis_proses_id=akta_ppat_jenis_proses.id')
            ->where(['akta_ppat_proses.akta_ppat_id' => $this->id])
            ->orderBy(['akta_ppat_proses.akta_ppat_jenis_proses_id' => SORT_DESC])
            ->limit(1)->asArray()->one();

        return $status['desk'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatJenisProses()
    {
        return $this->hasMany(AktaPpatJenisProses::className(), ['id' => 'akta_ppat_jenis_proses_id'])->viaTable('akta_ppat_proses', ['akta_ppat_id' => 'id']);
    }


     public static function getOptions(){
        $data=  static::find()
            ->select(['id','alamat'])
            ->where(['notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','alamat');

        return $value;
    }
}
