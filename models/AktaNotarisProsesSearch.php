<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaNotarisProses;

/**
 * AktaNotarisProsesSearch represents the model behind the search form about `app\models\AktaNotarisProses`.
 */
class AktaNotarisProsesSearch extends AktaNotarisProses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akta_notaris_jenis_proses_id', 'akta_notaris_id'], 'integer'],
            [['keterangan', 'tanggal'], 'safe'],
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
        $query = AktaNotarisProses::find();

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
            'akta_notaris_jenis_proses_id' => $this->akta_notaris_jenis_proses_id,
            'akta_notaris_id' => $this->akta_notaris_id,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
