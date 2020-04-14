<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaksi;

/**
 * AktaNotarisSearch represents the model behind the search form about `app\models\AktaNotaris`.
 */
class TransaksiSearch extends AktaNotaris
{
    public $nominal;
    public $tanggal;
    public $jenis;
    public $keterangan;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nominal'], 'integer'],
            //[['tanggal', 'nama', 'register'], 'safe'],
            [['tanggal', 'kategori_akun', 'keterangan'], 'safe'],
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
        $query = Transaksi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'kategori' => [
                    'asc' => ['jenis' => SORT_ASC],
                    'desc' => ['jenis' => SORT_DESC],
                    'label' => 'Kategori Akun'
                ],
                'nominal' => [
                    'asc' => ['nominal' => SORT_ASC],
                    'desc' => ['nomianl' => SORT_DESC],
                    'label' => 'Nominal',
                ],
                
                'tanggal' => [
                    'asc' => ['tanggal' => SORT_ASC],
                    'desc' => ['tanggal' => SORT_DESC],
                    'label' => 'Tanggal'
                    //'default' => SORT_ASC
                ],
                'keterangan' => [
                    'asc' => ['keterangan.jenis' => SORT_ASC],
                    'desc' => ['keterangan.jenis' => SORT_DESC],
                    'label' => 'keterangan'
                ],
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
            'transaksi.notaris_id' => Yii::$app->user->identity->notaris_id,
            'nominal' => $this->nominal,
            'tanggal' => $this->tanggal,
            //'akta_notaris_jenis_id' => $this->akta_notaris_jenis_id,
            //'corporate_client_id' => $this->corporate_client_id,
            //'user_id' => $this->user_id,
        ]);

        $query->joinWith(['kategori_akun' => function ($q) {
            $q->where('kategori_akun.name LIKE "%' . $this->jenis . '%"');
        }]);
        // if(!$this->clientName==''){
        //     $query->joinWith(['corporateClient' => function ($q) {
        //         $q->where('corporate_client.nama LIKE "%' . $this->clientName . '%"');
        //     }]);
        // }
        // if(Yii::$app->user->identity->role == User::ROLE_CLIENT){
        //     $client = CorporateClient::find()
        //         ->select(['id'])
        //         ->where(['user_id'=>Yii::$app->user->identity->id])
        //         ->asArray()->one();
        //     $query->andFilterWhere(['corporate_client_id'=>$client['id']]);
        // }

        // $query->andFilterWhere(['like', 'nama', $this->nama])
        //     ->andFilterWhere(['like', 'register', $this->register]);

        return $dataProvider;
    }
}
