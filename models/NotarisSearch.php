<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notaris;

/**
 * NotarisSearch represents the model behind the search form about `app\models\Notaris`.
 */
class NotarisSearch extends Notaris
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kelurahan_id'], 'integer'],
            [['nama', 'email', 'telepon', 'alamat', 'rt', 'rw', 'dusun', 'group', 'npwp'], 'safe'],
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
        $query = Notaris::find();

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
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telepon', $this->telepon])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'dusun', $this->dusun])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['like', 'npwp', $this->npwp]);

        return $dataProvider;
    }
}
