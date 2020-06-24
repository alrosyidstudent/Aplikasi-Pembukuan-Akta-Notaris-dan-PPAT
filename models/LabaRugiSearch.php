<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LabaRugi;

/**
 * LabaRugiSearch represents the model behind the search form about `app\models\LabaRugi`.
 */
class LabaRugiSearch extends LabaRugi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nominal', 'notaris_id', 'akta_ppat_id', 'akta_notaris_id', 'akta_badan_id', 'kategori_akun_id'], 'integer'],
            [['jenis', 'tanggal', 'keterangan'], 'safe'],
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
        $query = LabaRugi::find();

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
            'tanggal' => $this->tanggal,
            'notaris_id' => $this->notaris_id,
            'akta_ppat_id' => $this->akta_ppat_id,
            'akta_notaris_id' => $this->akta_notaris_id,
            'akta_badan_id' => $this->akta_badan_id,
            'kategori_akun_id' => $this->kategori_akun_id,
        ]);

        $query->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
