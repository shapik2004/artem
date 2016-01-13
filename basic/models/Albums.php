<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11/18/15
 * Time: 1:07 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Albums extends ActiveRecord
{
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'id']);
    }
}