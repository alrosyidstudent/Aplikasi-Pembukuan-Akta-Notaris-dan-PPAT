<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaPpatPihak;

/**
 * AktaPpatPihakSearch represents the model behind the search form about `app\models\AktaPpatPihak`.
 */
class AktaPpatPihakSearch extends AktaPpatPihak
{
    public $kelurahanName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kelurahan_id', 'akta_ppat_id'], 'integer'],
            [['kelurahanName','selaku', 'nama', 'alamat', 'rt', 'rw', 'dusun', 'npwp', 'nik', 'alamat_sementara'], 'safe'],
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
        $query = AktaPpatPihak::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'nama' => [
                    'asc' => ['nama' => SORT_ASC],
                    'desc' => ['nama' => SORT_DESC],
                    'label' => 'Nama'
                ],

                'kelurahanName' => [
                    'asc' => ['kelurahan.nama' => SORT_ASC],
                    'desc' => ['kelurahan.nama' => SORT_DESC],
                    'label' => 'Kelurahan'
                ],

            ]
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
            //'akta_ppat_id' => $this->akta_ppat_id,
        ]);

        $query->joinWith(['kelurahan' => function ($q) {
            $q->where('kelurahan.nama LIKE "%' . $this->kelurahanName . '%"');
        }]);

        $query->andFilterWhere(['like', 'selaku', $this->selaku])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'dusun', $this->dusun])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'alamat_sementara', $this->alamat_sementara]);

        return $dataProvider;
    }
}
