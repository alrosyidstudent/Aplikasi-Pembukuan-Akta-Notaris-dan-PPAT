<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $level
 */
class Users extends \yii\db\ActiveRecord
{
    public function afterValidate(){
        parent::afterValidate();
        $this->password = $this->encrypt($this->password);

    }

    public  function encrypt($value){
        return md5($value);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'level'], 'required'],
            [['level'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'level' => 'Level',
        ];
    }
}
