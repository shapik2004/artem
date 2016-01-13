<?php


namespace app\models;



use yii\base\Model;
use yii\db\ActiveRecord;

class Info extends Model
{




 public function rules(){
     return[
             [['id', 'name', 'email']],
             [['name'], 'string'],
             [['email'], 'string'],

     ];
 }
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id']);
    }

}