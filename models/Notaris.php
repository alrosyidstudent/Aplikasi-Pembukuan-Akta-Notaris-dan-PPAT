<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notaris".
 *
 * @property integer $id
 * @property string $nama
 * @property string $email
 * @property string $telepon
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property integer $kelurahan_id
 * @property string $group
 * @property string $npwp
 *
 * @property AktaBadan[] $aktaBadans
 * @property AktaBadanJenisProses[] $aktaBadanJenisProses
 * @property AktaNotaris[] $aktaNotaris
 * @property AktaNotarisJenis[] $aktaNotarisJenis
 * @property AktaNotarisJenisProses[] $aktaNotarisJenisProses
 * @property AktaPpat[] $aktaPpats
 * @property AktaPpatJenisProses[] $aktaPpatJenisProses
 * @property CorporateClient[] $corporateClients
 * @property Credit[] $credits
 * @property DetilUser[] $detilUsers
 * @property Kelurahan $kelurahan
 * @property PemasukanJenis[] $pemasukanJenis
 * @property PengeluaranJenis[] $pengeluaranJenis
 * @property SuratBawahTangan[] $suratBawahTangans
 * @property SuratSifat[] $suratSifats
 * @property User[] $users
 */
class Notaris extends \yii\db\ActiveRecord
{
    public $provinsi_id;
    public $kabupaten_id;
    public $kecamatan_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notaris';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['kelurahan_id'], 'integer'],
            [['nama', 'email', 'alamat'], 'string', 'max' => 100],
            [['telepon', 'rt', 'rw', 'dusun', 'group', 'npwp'], 'string', 'max' => 45],
            [['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'email' => 'Email',
            'telepon' => 'Telepon',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'dusun' => 'Dusun',
            'kelurahan_id' => 'Kelurahan ID',
            'group' => 'Group',
            'npwp' => 'Npwp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadans()
    {
        return $this->hasMany(AktaBadan::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanJenisProses()
    {
        return $this->hasMany(AktaBadanJenisProses::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotaris()
    {
        return $this->hasMany(AktaNotaris::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisJenis()
    {
        return $this->hasMany(AktaNotarisJenis::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisJenisProses()
    {
        return $this->hasMany(AktaNotarisJenisProses::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpats()
    {
        return $this->hasMany(AktaPpat::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatJenisProses()
    {
        return $this->hasMany(AktaPpatJenisProses::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateClients()
    {
        return $this->hasMany(CorporateClient::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCredits()
    {
        return $this->hasMany(Credit::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetilUsers()
    {
        return $this->hasMany(DetilUser::className(), ['notaris_id' => 'id']);
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
    public function getPemasukanJenis()
    {
        return $this->hasMany(PemasukanJenis::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengeluaranJenis()
    {
        return $this->hasMany(PengeluaranJenis::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratBawahTangans()
    {
        return $this->hasMany(SuratBawahTangan::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratSifats()
    {
        return $this->hasMany(SuratSifat::className(), ['notaris_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['notaris_id' => 'id']);
    }
}
