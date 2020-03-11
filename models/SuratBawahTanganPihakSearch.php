<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SuratBawahTanganPihak;

/**
 * SuratBawahTanganPihakSearch represents the model behind the search form about `app\models\SuratBawahTanganPihak`.
 */
class SuratBawahTanganPihakSearch extends SuratBawahTanganPihak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'surat_bawah_tangan_id', 'kelurahan_id'], 'integer'],
            [['selaku', 'nama', 'alamat', 'rt', 'rw', 'dusun'], 'safe'],
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
        $query = SuratBawahTanganPihak::find();

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
            'surat_bawah_tangan_id' => $this->surat_bawah_tangan_id,
            'kelurahan_id' => $this->kelurahan_id,
        ]);

        $query->andFilterWhere(['like', 'selaku', $this->selaku])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'dusun', $this->dusun]);

        return $dataProvider;
    }
}
