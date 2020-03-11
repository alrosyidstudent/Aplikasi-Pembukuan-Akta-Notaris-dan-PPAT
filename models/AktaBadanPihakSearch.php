<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaBadanPihak;

/**
 * AktaBadanPihakSearch represents the model behind the search form about `app\models\AktaBadanPihak`.
 */
class AktaBadanPihakSearch extends AktaBadanPihak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kelurahan_id', 'akta_badan_id', 'akta_badan_akta_badan_jenis_id'], 'integer'],
            [['selaku', 'nama', 'alamat', 'rt', 'rw', 'dusun', 'npwp', 'nik'], 'safe'],
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
        $query = AktaBadanPihak::find();

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
            'kelurahan_id' => $this->kelurahan_id,
            'akta_badan_id' => $this->akta_badan_id,
            'akta_badan_akta_badan_jenis_id' => $this->akta_badan_akta_badan_jenis_id,
        ]);

        $query->andFilterWhere(['like', 'selaku', $this->selaku])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'dusun', $this->dusun])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'nik', $this->nik]);

        return $dataProvider;
    }
}
