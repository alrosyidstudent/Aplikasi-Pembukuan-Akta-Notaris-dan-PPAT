<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "akta_ppat_jenis".
 *
 * @property integer $id
 * @property string $name
 * @property string $deskripsi
 *
 * @property AktaPpat[] $aktaPpats
 * @property AktaPpatJenisProses[] $aktaPpatJenisProses
 */
class AktaPpatJenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akta_ppat_jenis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
            [['deskripsi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpats()
    {
        return $this->hasMany(AktaPpat::className(), ['akta_ppat_jenis_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktaPpatJenisProses()
    {
        return $this->hasMany(AktaPpatJenisProses::className(), ['akta_ppat_jenis_id' => 'id']);
    }

    public static function getOptions()
    {
        $data = static::find()->all();
        $value = (count($data) == 0) ? ['' => ''] : \yii\helpers\ArrayHelper::map($data, 'id', 'name');

        return $value;
    }

    public function getProsess()
    {
        $proses_akta = '';
        $a_prosess = AktaPpatJenisProses::find()
            ->where(['akta_ppat_jenis_id' => $this->id])->all();
        $n_prosess = count($a_prosess);
        $n = 0;
        foreach ($a_prosess as $proses) {
            $n++;
            $proses_akta = $proses_akta . ' ' . $proses->deskripsi;
            if ($n != $n_prosess) {
                $proses_akta .= ', ';
            }
        }
        return $proses_akta;
    }
///
}
