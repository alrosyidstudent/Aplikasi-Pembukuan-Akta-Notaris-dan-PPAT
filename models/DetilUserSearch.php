<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetilUser;

/**
 * DetilUserSearch represents the model behind the search form about `app\models\DetilUser`.
 */
class DetilUserSearch extends DetilUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notaris_id', 'user_id', 'kelurahan_id'], 'integer'],
            [['nama', 'detil_usercol', 'alamat', 'rt', 'rw', 'desa_kel'], 'safe'],
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
        $query = DetilUser::find();

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
            'notaris_id' => $this->notaris_id,
            'user_id' => $this->user_id,
            'kelurahan_id' => $this->kelurahan_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'detil_usercol', $this->detil_usercol])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'desa_kel', $this->desa_kel]);

        return $dataProvider;
    }
}
