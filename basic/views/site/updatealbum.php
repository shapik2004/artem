<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Update album: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['albums','id_user'=>$model->user_id]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posts-update">



    <?= $this->render('newalbumform', [
        'model' => $model,

    ]) ?>

</div>
