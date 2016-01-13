<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11/23/15
 * Time: 5:12 PM
 */

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\LoginForm;

class NewAlbum extends ActiveRecord

{
   public static function tableName()
    {
        return 'albums';
    }

   // public $name_album;
   // public $album_desk;
    //public $user_id;


    public function rules()
    {
        return[
        [['name_album','album_desk'],'required'],
        [['name_album'],'string'],
        [['album_desk'] ,'string'],
        //[['user_id'],'integer'],

        ];

    }
   public function attributeLabels(){
        return[
        'name_album'=>'Имя альбома',
        'album_desk'=>'Описание альбома'
        ];
    }
  /* public function add()
    {
        $album = new Albums();
        $album->name_album = $this->name_album;
        $album->album_desk = $this->album_desk;
        $album->user_id=$this->user_id;
        return $album->save();


    }*/

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id привет']);
    }
}