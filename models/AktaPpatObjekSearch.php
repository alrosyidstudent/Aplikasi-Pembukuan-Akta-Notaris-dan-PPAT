<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaPpatObjek;

/**
 * AktaPpatObjekSearch represents the model behind the search form about `app\models\AktaPpatObjek`.
 */
class AktaPpatObjekSearch extends AktaPpatObjek
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'akta_ppat_id', 'luas_tanah', 'luas_bangunan', 'njop_tanah', 'njop_bangunan', 'nilai_pengalihan', 'bphtb', 'pph'], 'integer'],
            [['status_objek', 'nop', 'nomor_pajak', 'ntpn', 'keterangan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AktaPpatObjek::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'akta_ppat_id' => $this->akta_ppat_id,
            'luas_tanah' => $this->luas_tanah,
            'luas_bangunan' => $this->luas_bangunan,
            'njop_tanah' => $this->njop_tanah,
            'njop_bangunan' => $this->njop_bangunan,
            'nilai_pengalihan' => $this->nilai_pengalihan,
            'bphtb' => $this->bphtb,
            'pph' => $this->pph,
        ]);

        $query->andFilterWhere(['like', 'status_objek', $this->status_objek])
            ->andFilterWhere(['like', 'nop', $this->nop])
            ->andFilterWhere(['like', 'nomor_pajak', $this->nomor_pajak])
            ->andFilterWhere(['like', 'ntpn', $this->ntpn])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
