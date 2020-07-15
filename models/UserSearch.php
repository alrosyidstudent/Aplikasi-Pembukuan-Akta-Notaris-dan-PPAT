<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;


/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    public $ccName, $ccAlamat, $notarisName, $staffName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'password', 'authKey', 'accessToken', 'role','ccName','ccAlamat','notarisName','staffName','status'], 'safe'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'username',
                'ccName' => [
                    'asc' => ['corporate_client.nama' => SORT_ASC],
                    'desc' => ['corporate_client.nama' => SORT_DESC],
                    'label' => 'Nama'
                ],
                'ccAlamat' => [
                    'asc' => ['corporate_client.alamat' => SORT_ASC],
                    'desc' => ['corporate_client.alamat' => SORT_DESC],
                    'label' => 'Alamat'
                ],
                'staffName' => [
                    'asc' => ['detil_user.nama' => SORT_ASC],
                    'desc' => ['detil_user.nama' => SORT_DESC],
                    'label' => 'Nama'
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
            'id' => $this->id,
        ]);


        if (((Yii::$app->user->identity->role == User::ROLE_NOTARIS) or (Yii::$app->user->identity->role == User::ROLE_STAFFS))
            and Yii::$app->controller->action->id == 'cindex') {
            $query->andWhere(['user.notaris_id'=>Yii::$app->user->identity->notaris_id,
                            'role'=>'cclient']);

            $query->joinWith(['corporateClient' => function ($q) {
                $q->where('corporate_client.nama LIKE "%' . $this->ccName . '%"');
                $q->andWhere('corporate_client.nama LIKE "%' . $this->ccAlamat . '%"');
            }]);
        }

        if (Yii::$app->user->identity->role == User::ROLE_NOTARIS and Yii::$app->controller->action->id == 'sindex') {
            $query->andWhere(['user.notaris_id'=>Yii::$app->user->identity->notaris_id,
                'role'=>'staff']);

            $query->joinWith(['detilUser' => function ($q) {
                $q->where('detil_user.nama LIKE "%' . $this->staffName . '%"');
            }]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}