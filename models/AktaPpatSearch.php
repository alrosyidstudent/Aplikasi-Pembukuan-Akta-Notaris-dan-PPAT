<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AktaPpat;

/**
 * AktaPpatSearch represents the model behind the search form about `app\models\AktaPpat`.
 */
class AktaPpatSearch extends AktaPpat
{
    public $jenis;
    public $pic;
    public $clientName;
    public $kelurahanName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notaris_id', 'akta_ppat_jenis_id', 'kelurahan_id', 'corporate_client_id', 'user_id', 'luas_tanah', 'luas_bangunan', 'nilai_pengalihan', 'njop_tanah', 'njop_bangunan', 'ssp_nilai', 'sspd_nilai'], 'integer'],
            [['kelurahanName','nomor', 'alamat', 'rt', 'rw', 'dusun', 'register', 'nop', 'ssp_tanggal', 'sspd_tanggal','jenis', 'pic', 'clientName'], 'safe'],
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
        $query = AktaPpat::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'jenis' => [
                    'asc' => ['akta_ppaat_jenis.nama' => SORT_ASC],
                    'desc' => ['akta_ppat_jenis.nama' => SORT_DESC],
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
                'kelurahanName' => [
                    'asc' => ['kelurahan.nama' => SORT_ASC],
                    'desc' => ['kelurahan.nama' => SORT_DESC],
                    'label' => 'Kelurahan'
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
            'akta_ppat.notaris_id' => Yii::$app->user->identity->notaris_id,
            'nomor' => $this->nomor,
            'tanggal' => $this->tanggal,
            /*'id' => $this->id,
            'notaris_id' => $this->notaris_id,
            'akta_ppat_jenis_id' => $this->akta_ppat_jenis_id,
            'kelurahan_id' => $this->kelurahan_id,
            'corporate_client_id' => $this->corporate_client_id,
            'user_id' => $this->user_id,
            'luas_tanah' => $this->luas_tanah,
            'luas_bangunan' => $this->luas_bangunan,
            'nilai_pengalihan' => $this->nilai_pengalihan,
            'njop_tanah' => $this->njop_tanah,
            'njop_bangunan' => $this->njop_bangunan,
            'ssp_tanggal' => $this->ssp_tanggal,
            'ssp_nilai' => $this->ssp_nilai,
            'sspd_tanggal' => $this->sspd_tanggal,
            'sspd_nilai' => $this->sspd_nilai,*/
        ]);

        $query->joinWith(['aktaPpatJenis' => function ($q) {
            $q->where('akta_ppat_jenis.name LIKE "%' . $this->jenis . '%"');
        }]);
        if(!$this->clientName==''){
            $query->joinWith(['corporateClient' => function ($q) {
                $q->where('corporate_client.nama LIKE "%' . $this->clientName . '%"');
            }]);
        }
        $query->joinWith(['kelurahan' => function ($q) {
            $q->where('kelurahan.nama LIKE "%' . $this->kelurahanName . '%"');
        }]);

        $query->andFilterWhere(['like', 'register', $this->register]);

        if(Yii::$app->user->identity->role == User::ROLE_CLIENT){
            $client = CorporateClient::find()
                ->select(['id'])
                ->where(['user_id'=>Yii::$app->user->identity->id])
                ->asArray()->one();
            $query->andFilterWhere(['corporate_client_id'=>$client['id']]);
        }
        /*$query->andFilterWhere(['like', 'nomor', $this->nomor])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'dusun', $this->dusun])
            ->andFilterWhere(['like', 'register', $this->register])
            ->andFilterWhere(['like', 'nop', $this->nop]);*/

        return $dataProvider;
    }
}
