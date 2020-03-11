<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kelurahan".
 *
 * @property integer $id
 * @property integer $kecamatan_id
 * @property string $nama
 *
 * @property AktaBadan[] $aktaBadans
 * @property AktaBadanPihak[] $aktaBadanPihaks
 * @property AktaNotarisPihak[] $aktaNotarisPihaks
 * @property AktaPpat[] $aktaPpats
 * @property AktaPpatPihak[] $aktaPpatPihaks
 * @property DetilUser[] $detilUsers
 * @property Kecamatan $kecamatan
 * @property Notaris[] $notaris
 * @property SuratBawahTanganPihak[] $suratBawahTanganPihaks
 */
class Kelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelurahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kecamatan_id'], 'required'],
            [['id', 'kecamatan_id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kecamatan_id' => 'Kecamatan ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadans()
    {
        return $this->hasMany(AktaBadan::className(), ['kelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanPihaks()
    {
        return $this->hasMany(AktaBadanPihak::className(), ['kelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaNotarisPihaks()
    {
        return $this->hasMany(AktaNotarisPihak::className(), ['kelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpats()
    {
        return $this->hasMany(AktaPpat::className(), ['kelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatPihaks()
    {
        return $this->hasMany(AktaPpatPihak::className(), ['kelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetilUsers()
    {
        return $this->hasMany(DetilUser::className(), ['kelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'kecamatan_id']);
    }
    public function getKecamatanName()
    {
        return $this->kecamatan->nama;
    }
    public function getKabupatenName()
    {
        $kabupaten=Kabupaten::find()
            ->select(['nama'])
            ->where(['id'=>substr($this->id,0,4)])->asArray()->one();
        return $kabupaten['nama'];
    }
    public function getProvinsiName()
    {
        $provinsi=Provinsi::find()
            ->select(['nama'])
            ->where(['id'=>substr($this->id,0,2)])->asArray()->one();
        return $provinsi['nama'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasMany(Notaris::className(), ['kelurahan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratBawahTanganPihaks()
    {
        return $this->hasMany(SuratBawahTanganPihak::className(), ['kelurahan_id' => 'id']);
    }

    public static function getKelurahanByKecamatan($kecamatan_id) {

        $data = static::find()
            ->select(['id','nama as name'])
            ->where(['kecamatan_id'=>$kecamatan_id])
            ->orderBy('nama')
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getKelurahanSelected($kelurahan_id) {
        $data = static::find()
            ->select(['id','nama as name'])
            ->where(['id'=>$kelurahan_id])
            ->orderBy('nama')
            ->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public static function getKelurahanSelectedKecamatan($kecamatan_id) {
        $data =  static::find()
            ->where(['kecamatan_id'=>$kecamatan_id])
            ->orderBy('nama')->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','nama');

        return $value;
    }
}
