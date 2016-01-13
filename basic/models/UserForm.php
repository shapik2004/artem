<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class UserForm extends Model
{


    public $name;
    public $email;
    public $password;
    public $status;


    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'password'], 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['name', 'unique',
                'targetClass' => Users::className(),
                'message' => 'это имя занято'],
            [['email'], 'email'],
            ['email', 'unique',
                'targetClass' => Users::className(),
                'message' => 'Почта зарегистрирована'],
            ['status', 'default', 'value' => Users::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' => [
                Users::STATUS_NOT_ACTIVE,
                Users::STATUS_ACTIVE
            ]],

            ['password', 'required', 'on' => 'create'],


        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'status' => 'Status',
            'auth_key' => 'Auth_key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'


        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $users = new Users();
            $users->name = $this->name;
            $users->email = $this->email;
            $users->status = $this->status;
            $users->setPassword($this->password);
            $users->generateAuthKey();

            return $users->save() ? $users : null;
        }
        return null;
    }
}
