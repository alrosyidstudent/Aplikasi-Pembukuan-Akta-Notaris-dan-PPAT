<?php
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $role
 * @property integer $notaris_id
 * @property string $status
 *
 * @property DetilUser[] $detilUsers
 * @property Notaris $notaris
 */

namespace app\models;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_STAFF = 'staff';
    const ROLE_NOTARIS = 'notaris';
    const ROLE_CLIENT = 'cclient';
    const ROLE_SUPER = 'super';
    public $password_repeat;
    public $tr,$nama,$site_id,$alamat;
    //public $ccName,$ccAlamat,$notarisName;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','authKey','accessToken','role'], 'string', 'max' => 255],
            [['username', 'password','password_repeat', 'role'], 'required'],
            [['nama','role','notaris_id','status'], 'required', 'on' => 'update'],
            [['password','password_repeat'], 'required', 'on' => 'change_password'],
            [['username'], 'string', 'max' => 100],
            [['username'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['username'], 'unique'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords tidak sesuai" ],
            [['notaris_id'], 'integer'],
            [['status','role'], 'string', 'max' => 10],
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['nama','role','notaris_id','status'];
        $scenarios['change_password'] = ['password','password_repeat'];
        return $scenarios;
    }

    public function beforeSave($insert)
    {
        /*if(Yii::$app->user->identity->accessToken==1){
            $this->accessToken=1;
        }else{
            $this->accessToken="";
        }*/
        /*if(is_null($this->accessToken)){
            $this->accessToken=Yii::$app->user->identity->accessToken;
        }*/

        if(parent::beforeSave($insert)){
            if(!is_null($this->password_repeat)){
                $this->password= Yii::$app->security->generatePasswordHash($this->password);
            }
            $this->authKey="";
            return true;
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notaris_id' => 'Notaris',
            'nama' => 'Nama Lengkap',
            'status' => 'Status',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'role' => 'Role',
            'ccName' => 'Nama',
            'ccAlamat' => 'Alamat',
            'notarisName' => 'Nama Notaris',
            'staffName' => 'Nama',
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::find()->where(['id'=>$id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['username'=>$username])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    //Notaris
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }

    public  function getNotarisName()
    {
        return $this->notaris->nama;
    }

    // Corporate client
    public function getCorporateClient()
    {
        return $this->hasOne(CorporateClient::className(), ['user_id' => 'id']);
    }

    public  function getCcName()
    {
        return $this->corporateClient->nama;
    }

    public  function getCcAlamat()
    {
        return $this->corporateClient->alamat;
    }

    public function getDetilUser()
    {
        return $this->hasOne(DetilUser::className(), ['user_id' => 'id']);
    }

    // Staff
    /*public function getStaff()
    {
        return $this->hasOne(DetilUser::className(), ['user_id' => 'id']);
    }*/

    public  function getStaffName()
    {
        return $this->detilUser->nama;
    }

    /*public static function getOptionstaff(){
        $data=  static::find()
            ->select(['user.id as id','detil_user.nama as nama'])
            ->leftJoin('detil_user', 'user.id=detil_user.user_id')
            ->where(['user.notaris_id'=>Yii::$app->user->identity->notaris_id])
            ->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','nama');

        return $value;
    }*/
}
