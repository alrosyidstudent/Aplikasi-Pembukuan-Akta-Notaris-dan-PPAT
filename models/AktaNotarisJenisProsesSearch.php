<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaNotarisJenisProses;

/**
 * AktaNotarisJenisProsesSearch represents the model behind the search form about `app\models\AktaNotarisJenisProses`.
 */
class AktaNotarisJenisProsesSearch extends AktaNotarisJenisProses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'akta_notaris_jenis_id', 'notaris_id'], 'integer'],
            [['deskripsi'], 'safe'],
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
        $query = AktaNotarisJenisProses::find();

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
            'akta_notaris_jenis_id' => $this->akta_notaris_jenis_id,
            'notaris_id' => $this->notaris_id,
        ]);

        $query->andFilterWhere(['like', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
