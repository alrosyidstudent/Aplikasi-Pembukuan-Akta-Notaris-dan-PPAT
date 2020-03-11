<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_notaris_pihak".
 *
 * @property integer $id
 * @property integer $akta_notaris_id
 * @property string $selaku
 * @property string $nama
 * @property string $alamat
 * @property string $rt
 * @property string $rw
 * @property string $dusun
 * @property integer $kelurahan_id
 * @property string $npwp
 * @property string $nik
 *
 * @property Kelurahan $kelurahan
 * @property AktaNotaris $aktaNotaris
 */
class AktaNotarisPihak extends \yii\db\ActiveRecord
{
    public $provinsi_id;
    public $kabupaten_id;
    public $kecamatan_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_notaris_pihak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_notaris_id', 'kelurahan_id'], 'required'],
            [['akta_notaris_id', 'kelurahan_id'], 'integer'],
            [['selaku', 'nama'], 'string', 'max' => 60],
            [['alamat'], 'string', 'max' => 100],
            [['rt', 'rw'], 'string', 'max' => 5],
            [['dusun', 'npwp', 'nik'], 'string', 'max' => 45],
            [['kelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['kelurahan_id' => 'id']],
            [['akta_notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaNotaris::className(), 'targetAttribute' => ['akta_notaris_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'akta_notaris_id' => 'Akta Notaris ID',
            'selaku' => 'Selaku',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'dusun' => 'Dusun',
            'kelurahan_id' => 'Kelurahan',
            'kelurahanName' => 'Kelurahan',
            'kecamatan_id' => 'Kecamatan',
            'kecamatanName'=>'Kecamatan',
            'kabupaten_id' => 'Kabupaten',
            'kabupatenName'=>'Kabupaten',
            'provinsi_id' => 'Provinsi',
            'npwp' => 'NPWP',
            'nik' => 'NIK',
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

    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => $this->kelurahan->kecamatan_id]);
    }
    public function getKecamatanName()
    {
        $kecamatan=Kecamatan::find()->where(['id'=>$this->kelurahan->kecamatan_id])->one();
        return $kecamatan->nama;
    }
    public function getKabupatenName()
    {
        $kabupaten=Kabupaten::find()
            ->select(['nama'])
            ->where(['id'=>substr($this->kelurahan->kecamatan_id,0,4)])->asArray()->one();
        return $kabupaten['nama'];
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotaris()
    {
        return $this->hasOne(AktaNotaris::className(), ['id' => 'akta_notaris_id']);
    }
}
