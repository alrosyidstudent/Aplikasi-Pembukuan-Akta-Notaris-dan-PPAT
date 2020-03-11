<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaNotaris;

/**
 * AktaNotarisSearch represents the model behind the search form about `app\models\AktaNotaris`.
 */
class AktaNotarisSearch extends AktaNotaris
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
            [['id', 'notaris_id', 'nomor', 'akta_notaris_jenis_id', 'corporate_client_id', 'user_id'], 'integer'],
            //[['tanggal', 'nama', 'register'], 'safe'],
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
        $query = AktaNotaris::find();

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
                    'asc' => ['akta_notaris_jenis.nama' => SORT_ASC],
                    'desc' => ['akta_notaris_jenis.nama' => SORT_DESC],
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
            'akta_notaris.notaris_id' => Yii::$app->user->identity->notaris_id,
            'nomor' => $this->nomor,
            'tanggal' => $this->tanggal,
            //'akta_notaris_jenis_id' => $this->akta_notaris_jenis_id,
            //'corporate_client_id' => $this->corporate_client_id,
            //'user_id' => $this->user_id,
        ]);

        $query->joinWith(['aktaNotarisJenis' => function ($q) {
            $q->where('akta_notaris_jenis.name LIKE "%' . $this->jenis . '%"');
        }]);
        if(!$this->clientName==''){
            $query->joinWith(['corporateClient' => function ($q) {
                $q->where('corporate_client.nama LIKE "%' . $this->clientName . '%"');
            }]);
        }
        if(Yii::$app->user->identity->role == User::ROLE_CLIENT){
            $client = CorporateClient::find()
                ->select(['id'])
                ->where(['user_id'=>Yii::$app->user->identity->id])
                ->asArray()->one();
            $query->andFilterWhere(['corporate_client_id'=>$client['id']]);
        }

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'register', $this->register]);

        return $dataProvider;
    }
}
