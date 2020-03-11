<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_badan_jenis_proses".
 *
 * @property integer $id
 * @property string $deskripsi
 * @property integer $notaris_id
 * @property integer $jangka_waktu
 * @property string $peringatkan
 * @property integer $akta_badan_jenis_sifat_id
 * @property integer $akta_badan_jenis_sifat_akta_badan_jenis_id
 *
 * @property AktaBadanJenisSifat $aktaBadanJenisSifat
 * @property Notaris $notaris
 * @property AktaBadanProses[] $aktaBadanProses
 */
class AktaBadanJenisProses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_badan_jenis_proses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_badan_jenis_sifat_id', 'akta_badan_jenis_sifat_akta_badan_jenis_id'], 'required'],
            [['notaris_id', 'jangka_waktu', 'akta_badan_jenis_sifat_id', 'akta_badan_jenis_sifat_akta_badan_jenis_id'], 'integer'],
            [['deskripsi'], 'string', 'max' => 100],
            [['peringatkan'], 'string', 'max' => 5],
            //[['akta_badan_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadanJenis::className(), 'targetAttribute' => ['akta_badan_jenis_id' => 'id']],
            [['akta_badan_jenis_sifat_id', 'akta_badan_jenis_sifat_akta_badan_jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => AktaBadanJenisSifat::className(), 'targetAttribute' => ['akta_badan_jenis_sifat_id' => 'id', 'akta_badan_jenis_sifat_akta_badan_jenis_id' => 'akta_badan_jenis_id']],
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
            'deskripsi' => 'Deskripsi',
            'notaris_id' => 'Notaris ID',
            'jangka_waktu' => 'Jangka Waktu (hari)',
            'peringatkan' => 'Ingatkan batas waktu',
            'akta_badan_jenis_sifat_id' => 'Akta Badan Jenis Sifat ID',
            'akta_badan_jenis_sifat_akta_badan_jenis_id' => 'Akta Badan Jenis Sifat Akta Badan Jenis ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaBadanJenisSifat()
    {
        return $this->hasOne(AktaBadanJenisSifat::className(), ['id' => 'akta_badan_jenis_sifat_id', 'akta_badan_jenis_id' => 'akta_badan_jenis_sifat_akta_badan_jenis_id']);
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
    public function getAktaBadanProses()
    {
        return $this->hasMany(AktaBadanProses::className(), ['akta_badan_jenis_proses_id' => 'id']);
    }
}
