<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Depresiasi;

/**
 * DepresiasiSearch represents the model behind the search form about `app\models\Depresiasi`.
 */
class DepresiasiSearch extends Depresiasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nominal', 'akun_id'], 'integer'],
            [['keterangan'], 'string', 'max' => 255],
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
        $query = Depresiasi::find();

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
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'akun_id' => $this->akun_id,
        ]);

        return $dataProvider;
    }
}
