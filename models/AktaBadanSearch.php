<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaBadan;

/**
 * AktaBadanSearch represents the model behind the search form about `app\models\AktaBadan`.
 */
class AktaBadanSearch extends AktaBadan
{
    public $jenis;
    public $sifat;
    public $pic;
    public $clientName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notaris_id', 'nomor', 'kelurahan_id', 'corporate_client_id', 'akta_badan_jenis_id', 'akta_badan_jenis_sifat_id'], 'integer'],
            [['tanggal', 'nama', 'jenis','sifat', 'pic', 'clientName'], 'safe'],
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
        $query = AktaBadan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'nama' => [
                    'asc' => ['nama' => SORT_ASC],
                    'desc' => ['nama' => SORT_DESC],
                    'label' => 'Nama'
                ],
                'jenis' => [
                    'asc' => ['akta_badan_jenis.nama' => SORT_ASC],
                    'desc' => ['akta_badan_jenis.nama' => SORT_DESC],
                    'label' => 'Jenis',
                ],
                'nomor' => [
                    'asc' => ['nomor' => SORT_ASC],
                    'desc' => ['nomor' => SORT_DESC],
                    'label' => 'Nomor'
                    //'default' => SORT_ASC
                ],
                'tanggal' => [
                    'asc' => ['tanggal' => SORT_ASC],
                    'desc' => ['tanggal' => SORT_DESC],
                    'label' => 'Tanggal'
                    //'default' => SORT_ASC
                ],
                'clientName' => [
                    'asc' => ['corporate_client.nama' => SORT_ASC],
                    'desc' => ['corporate_client.nama' => SORT_DESC],
                    'label' => 'Client'
                ],
                'pic' => [
                    'asc' => ['pic' => SORT_ASC],
                    'desc' => ['pic' => SORT_DESC],
                    'label' => 'PIC'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //'id' => $this->id,
            'akta_badan.notaris_id' => Yii::$app->user->identity->notaris_id,
            //'akta_badan_jenis_sifat_id' => $this->akta_badan_jenis_sifat_id,
            //'kelurahan_id' => $this->kelurahan_id,
            'nomor' => $this->nomor,
            'tanggal' => $this->tanggal,
            //'corporate_client_id' => $this->corporate_client_id,
            //'akta_badan_jenis_id' => $this->akta_badan_jenis_id,
        ]);

        $query->joinWith(['aktaBadanJenis' => function ($q) {
            $q->where('akta_badan_jenis.name LIKE "%' . $this->jenis . '%"');
        }]);
        $query->joinWith(['aktaBadanJenisSifat' => function ($q) {
            $q->where('akta_badan_jenis_sifat.name LIKE "%' . $this->sifat . '%"');
        }]);

        /*if(!$this->clientName==''){
            $query->joinWith(['corporateClient' => function ($q) {
                $q->where('corporate_client.nama LIKE "%' . $this->clientName . '%"');
            }]);
        }*/
        /*$query->joinWith(['detilStaff' => function ($q) {
            $q->where('detil_staff.nama LIKE "%' . $this->pic . '%"');
        }]);*/

        $query->andFilterWhere(['like', 'nama', $this->nama])
            //->andFilterWhere(['like', 'alamat', $this->alamat])
            //->andFilterWhere(['like', 'rt', $this->rt])
            //->andFilterWhere(['like', 'rw', $this->rw])
            //->andFilterWhere(['like', 'dusun', $this->dusun])
            ->andFilterWhere(['like', 'register', $this->register]);

        return $dataProvider;
    }
}
