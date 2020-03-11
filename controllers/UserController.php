<?php

namespace app\controllers;

use app\models\CorporateClient;
use app\models\DetilUser;
use Yii;
use app\models\User;
use yii\rbac\Role;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\AccessRule;
use app\models\UserSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_NOTARIS,
                            User::ROLE_SUPER,
                        ],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_NOTARIS,
                            User::ROLE_SUPER,
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_NOTARIS,
                            User::ROLE_SUPER,
                        ],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_NOTARIS,
                            User::ROLE_SUPER,
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // index klien
    public function actionCindex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('cindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // index staff
    public function actionSindex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('sindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //view corporate client
    public function actionCview($id)
    {
        return $this->render('cview', [
            'model' => $this->findModel($id),
        ]);
    }

    //view staff
    public function actionSview($id)
    {
        return $this->render('sview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($role)
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $user = User::find()
                ->where(['username' => $model->username])
                ->one();
            if ($user) {
                return $this->render('create', [
                    'model' => $model,
                    'role' => $role,
                    'exist' => $model->username,
                    'update' => false
                ]);
            } else {
                $model->save();
                switch ($model->role) {
                    case 'client':
                        /*$model->nama=Yii::$app->request->post()['User']['nama'];
                        $model1=User::find()->where(['username'=>$model->username])->one();
                        $staff = new Staff();
                        $staff->user_id = $model1->id;
                        $staff->nama = $model->nama;
                        $staff->status =$model->status;
                        $staff->bagian_id = 3;
                        $staff->site_id = Yii::$app->request->post()['User']['site_id'];

                        $bt = new Blueteam();
                        $bt->nama = $model->nama;
                        $bt->site_id = Yii::$app->request->post()['User']['site_id'];
                        $bt->user_id = $model1->id;
                        $bt->insert();
                        $staff->insert();*/
                        break;
                    case 'staff':
                        /*$model->nama=Yii::$app->request->post()['User']['nama'];
                        $model1=User::find()->where(['username'=>$model->username])->one();
                        $staff = new Staff();
                        $staff->user_id = $model1->id;
                        $staff->nama = $model->nama;
                        $staff->status =$model->status;
                        $staff->bagian_id = 2;
                        $staff->site_id = Yii::$app->request->post()['User']['site_id'];
                        $kasir = new Kasir();
                        $kasir->nama = $model->nama;
                        $kasir->site_id = Yii::$app->request->post()['User']['site_id'];
                        $kasir->user_id = $model1->id;
                        $kasir->insert();
                        $staff->insert();*/
                        break;
                }
                /*echo '<pre>';
                        print_r($bt);
                        echo '</pre>';*/
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'role' => $role,
                'exist' => '',
                'update' => false
            ]);

        }
    }

    // create corporate client
    public function actionCcreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $user = User::find()
                ->where(['username' => $model->username])
                ->one();
            if ($user) {
                $cc= CorporateClient::find()
                    ->where(['user_id' => $user->id])
                    ->one();
                if(!$cc){
                    $cc = new CorporateClient();
                    $cc->user_id = $user->id;
                    $cc->notaris_id = $model->notaris_id;
                    $cc->nama = Yii::$app->request->post()['User']['nama'];
                    $cc->alamat = Yii::$app->request->post()['User']['alamat'];
                    $cc->insert();
                    return $this->redirect(['cview', 'id' => $model->id]);
                }else{
                    return $this->render('create', [
                        'model' => $model,
                        'role' => 'cclient',
                        'exist' => $model->username,
                        'update' => false
                    ]);
                }
            }else{
                /*echo '<pre>';
                print_r(Yii::$app->request->post());
                echo '</pre>';*/
                $model->save();
                $model->nama = Yii::$app->request->post()['User']['nama'];
                $model1 = User::find()->where(['username' => $model->username])->one();
                $cc = new CorporateClient();
                $cc->user_id = $model1->id;
                $cc->notaris_id = $model->notaris_id;
                $cc->nama = Yii::$app->request->post()['User']['nama'];
                $cc->alamat = Yii::$app->request->post()['User']['alamat'];
                $cc->insert();

                return $this->redirect(['cview', 'id' => $model->id]);
            }

        } else {
            return $this->render('ccreate', [
                'model' => $model,
                //'role' => $role,
                'exist' => '',
                'update' => false,
            ]);

        }
    }

    // create staff

    public function actionScreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $user = User::find()
                ->where(['username' => $model->username])
                ->one();
            if ($user) {
                $du= DetilUser::find()
                    ->where(['user_id' => $user->id])
                    ->one();
                if(!$du){
                    $du = new DetilUser();
                    $du->user_id = $user->id;
                    $du->notaris_id = $model->notaris_id;
                    $du->nama = Yii::$app->request->post()['User']['nama'];
                    $du->insert();
                    return $this->redirect(['sview', 'id'=>$model->id]);
                }else{
                    return $this->render('create', [
                        'model' => $model,
                        'role' => 'staff',
                        'exist' => $model->username,
                        'update' => false
                    ]);
                }
            }else{
                $model->save();
                $model->nama = Yii::$app->request->post()['User']['nama'];
                $model1 = User::find()->where(['username' => $model->username])->one();
                $du = new DetilUser();
                $du->user_id = $model1->id;
                $du->notaris_id = $model->notaris_id;
                $du->nama = Yii::$app->request->post()['User']['nama'];
                $du->insert();
                return $this->redirect(['sview', 'id'=>$model->id]);
                /*echo '<pre>';
                //print_r(Yii::$app->request->post());
                //print_r($model1->id);
                echo $model->id;
                echo '</pre>';*/

            }

        } else {
            return $this->render('screate', [
                'model' => $model,
                //'role' => $role,
                'exist' => '',
                'update' => false,
            ]);

        }
    }


    public function actionChangePassword($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('change_password');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_form_change_password', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'exist' => $model->username,
                'role' => $model->role,
                'update' => true
            ]);
        }
    }

    // update client
    public function actionCupdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        $cc = CorporateClient::find()
            ->where(['user_id'=>$model->id])
            ->one();
        $model->nama = $cc->nama;
        $model->alamat = $cc->alamat;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $cc->user_id = $model->id;
            $cc->notaris_id = $model->notaris_id;
            $cc->nama = Yii::$app->request->post()['User']['nama'];
            $cc->alamat = Yii::$app->request->post()['User']['alamat'];
            $cc->save();

            return $this->redirect(['cindex']);
        } else {
            return $this->render('cupdate', [
                'model' => $model,
                'exist' => $model->username,
                'role' => $model->role,
                'update' => true
            ]);
        }
    }

    // update staff
    public function actionSupdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        $du = DetilUser::find()
            ->where(['user_id'=>$model->id])
            ->one();
        $model->nama = $du->nama;
        $model->alamat = $du->alamat;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $du->user_id = $model->id;
            $du->notaris_id = $model->notaris_id;
            $du->nama = Yii::$app->request->post()['User']['nama'];
            $du->save();

            return $this->redirect(['sindex']);
        } else {
            return $this->render('supdate', [
                'model' => $model,
                'exist' => $model->username,
                'role' => $model->role,
                'update' => true
            ]);
        }
    }

    public function actionProfile()
    {
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(Yii::$app->homeUrl);
            /*return $this->render('profile', [
                'model' => $model,
            ]);*/
        } else {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
