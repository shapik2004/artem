<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11/18/15
 * Time: 1:43 PM
 */

namespace app\models;


use yii\base\Model;

class Album extends Model
{

    public $id;
    public $album_name;
    public $album_desk;

    public function tableName(){
        return 'albums';
    }
    public function rules(){
        return[
            [['id','album_name', 'album_desk']],
            [['id'], 'string'],
            [['album_name'], 'string'],
            [['album_desk'], 'string'],


        ];
    }


  /*  public function add(){

        $album= new Albums()
            $album->
    }*/
    public function getAlbum()
    {
        return $this->hasOne(Albums::className(), ['id' => 'id']);
    }


}