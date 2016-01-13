<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class Users extends ActiveRecord implements IdentityInterface{

    const STATUS_DELETE=0;
    const STATUS_ACTIVE=10;
    const STATUS_NOT_ACTIVE=1;
    public $password;

    public static function tableName(){
        return 'users';
    }

    public function rules(){
        return [
            [['name','email','password'],'filter','filter'=>'trim'],
            [['name','email','status'],'required'],
            [['email'],'email'],
            ['name','string','min'=>2, 'max'=>255],
            ['password','required','on'=>'create'],
            ['name','unique','message'=>'это имя занято'],
            ['email','unique','message'=>'Почта зарегистрирована']

        ];
    }


    public function atributeLables(){
        return[
            'id'=>'ID',
            'name'=>'Имя пользователя',
            'email'=>'Email',
            'password'=>'Password Hash',
            'status'=>'Status',
            'auth_key'=>'Auth_key',
            'created_at'=>'Created At',
            'updated_at'=>'Updated At'


        ];
    }


    public function behaviors(){
        return [TimestampBehavior::className()];
    }

    public function findByName($username){
        return Users::findOne([
            'name'=>$username]

        );
    }

    /*public static function findByUsername($username)
    {
        $users=self::getAllUsers();
        foreach ($users as $user) {
            if (strcasecmp($user['name'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
    public static function getAllUsers(){

        $users_=Users::find()->all();

        return $users_;

    }*/









    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->password_hash);
    }

    public static function findIdentity($id)
    {
        return static ::findOne([
            'id'=>$id,
            'status'=>self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }





}