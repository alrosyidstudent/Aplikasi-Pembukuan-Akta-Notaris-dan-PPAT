<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_ppat_pihak".
 *
 * @property integer $id
 * @property string $selaku
 * @property string $nama
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property integer $kelurahan_id
 * @property string $npwp
 * @property string $nik
 * @property integer $akta_ppat_id
 * @property string $alamat_sementara
 *
 * @property Kelurahan $kelurahan
 * @property AktaPpat $aktaPpat
 */
class AktaPpatPihak extends \yii\db\ActiveRecord
{
    public $provinsi_id;
    public $kabupaten_id;
    public $kecamatan_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_ppat_pihak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelurahan_id', 'akta_ppat_id'], 'required'],
            [['kelurahan_id', 'akta_ppat_id'], 'integer'],
            [['selaku', 'nama'], 'string', 'max' => 60],
            [['alamat', 'alamat_sementara'], 'string', 'max' => 100],
            [['rt', 'rw'], 'string', 'max' => 5],
            [['dusun', 'npwp', 'nik'], 'string', 'max' => 45],
            [['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
            [['akta_ppat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaPpat::className(), 'targetAttribute' => ['akta_ppat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'selaku' => 'Selaku',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'dusun' => 'Dusun',
            'kelurahan_id' => 'Kelurahan',
            'kelurahanName'=>'Kelurahan',
            'kecamatan_id'=>'Kecamatan',
            'kecamatanName'=>'Kecamatan',
            'kabupaten_id'=>'Kabupaten',
            'kabupatenName'=>'Kabupaten',
            'npwp' => 'NPWP',
            'nik' => 'NIK',
            'akta_ppat_id' => 'Akta Ppat ID',
            'alamat_sementara' => 'Alamat Sementara',
        ];
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
    public function getAktaPpat()
    {
        return $this->hasOne(AktaPpat::className(), ['id' => 'akta_ppat_id']);
    }
}
