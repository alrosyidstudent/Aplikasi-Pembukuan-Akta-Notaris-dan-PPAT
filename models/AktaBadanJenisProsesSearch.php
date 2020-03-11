<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaBadanJenisProses;

/**
 * AktaBadanJenisProsesSearch represents the model behind the search form about `app\models\AktaBadanJenisProses`.
 */
class AktaBadanJenisProsesSearch extends AktaBadanJenisProses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notaris_id', 'jangka_waktu', 'akta_badan_jenis_id'], 'integer'],
            [['deskripsi', 'peringatkan'], 'safe'],
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
        $query = AktaBadanJenisProses::find();

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
            'jangka_waktu' => $this->jangka_waktu,
            'akta_badan_jenis_id' => $this->akta_badan_jenis_id,
        ]);

        $query->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'peringatkan', $this->peringatkan]);

        return $dataProvider;
    }
}
