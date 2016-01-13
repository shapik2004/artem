<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class FotoForm extends ActiveRecord
{

    public $file;
    public $name;
    public $desk;
    public $id_album;
    public $foto_path;



    public function rules(){
        return[
            [['id_album','name','file'],'required'],
            [['id_album'],'integer'],
            [['name'],'string'],
            [['desk'],'string'],
            [['file'],'file'],

        ];
    }
    public function attributeLabels(){

        return [
            'name'=>'Название',
            'desk'=>'Описание',
            'file'=>'Прикрепить файл'
        ];
    }

    public function add()
    {
            $fotos = new Fotos();
            $fotos->namefoto = $this->name;
            $fotos->deskfoto = $this->desk;
            $fotos->id_album = $this->id_album;
            $fotos->foto_path=$this->foto_path;
            $fotos->save();
            return $fotos;


    }

    public function getAlbum()
    {
        return $this->hasOne(Albums::className(), ['album_id' => 'id']);
    }

}