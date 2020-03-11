<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_ppat_objek".
 *
 * @property integer $id
 * @property integer $akta_ppat_id
 * @property string $status_objek
 * @property string $nop
 * @property integer $luas_tanah
 * @property integer $luas_bangunan
 * @property string $nomor_pajak
 * @property integer $njop_tanah
 * @property integer $njop_bangunan
 * @property integer $nilai_pengalihan
 * @property string $ntpn
 * @property integer $bphtb
 * @property integer $pph
 * @property string $keterangan
 *
 * @property AktaPpat $aktaPpat
 */
class AktaPpatObjek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_ppat_objek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_ppat_id'], 'required'],
            [['akta_ppat_id', 'luas_tanah', 'luas_bangunan', 'njop_tanah', 'njop_bangunan', 'nilai_pengalihan', 'bphtb', 'pph'], 'integer'],
            [['status_objek', 'nop', 'nomor_pajak', 'ntpn'], 'string', 'max' => 45],
            [['keterangan'], 'string', 'max' => 100],
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
            'akta_ppat_id' => 'Akta Ppat ID',
            'status_objek' => 'Status Objek',
            'nop' => 'Nop',
            'luas_tanah' => 'Luas Tanah',
            'luas_bangunan' => 'Luas Bangunan',
            'nomor_pajak' => 'Nomor Pajak',
            'njop_tanah' => 'Njop Tanah',
            'njop_bangunan' => 'Njop Bangunan',
            'nilai_pengalihan' => 'Nilai Pengalihan',
            'ntpn' => 'Ntpn',
            'bphtb' => 'Bphtb',
            'pph' => 'Pph',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpat()
    {
        return $this->hasOne(AktaPpat::className(), ['id' => 'akta_ppat_id']);
    }
}
