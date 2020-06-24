<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Akun;

/**
 * AkunSearch represents the model behind the search form about `app\models\Akun`.
 */
class AkunSearch extends Akun
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'debit', 'kredit', 'notaris_id', 'kategori_akun_id'], 'integer'],
            [['nama', 'tanggal', 'ket'], 'safe'],
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
        $query = Akun::find()
        ->orderBy(['id' => SORT_DESC]);

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
            'debit' => $this->debit,
            'kredit' => $this->kredit,
            'tanggal' => $this->tanggal,
            'notaris_id' => $this->notaris_id,
            'kategori_akun_id' => $this->kategori_akun_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'ket', $this->ket]);
            // ->andFilterWhere(['like', 'kategoriAkun', $this->kategori_akun_id]);

        return $dataProvider;
    }
}
