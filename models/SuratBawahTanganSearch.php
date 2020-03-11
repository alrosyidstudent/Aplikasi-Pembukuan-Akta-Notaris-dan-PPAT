<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SuratBawahTangan;

/**
 * SuratBawahTanganSearch represents the model behind the search form about `app\models\SuratBawahTangan`.
 */
class SuratBawahTanganSearch extends SuratBawahTangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notaris_id', 'surat_sifat_id'], 'integer'],
            [['nomor_urut', 'tanggal', 'jenis'], 'safe'],
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
        $query = SuratBawahTangan::find();

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
            'tanggal' => $this->tanggal,
            'notaris_id' => $this->notaris_id,
            'surat_sifat_id' => $this->surat_sifat_id,
        ]);

        $query->andFilterWhere(['like', 'nomor_urut', $this->nomor_urut])
            ->andFilterWhere(['like', 'jenis', $this->jenis]);

        return $dataProvider;
    }
}
