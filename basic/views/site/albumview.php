<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

$this->title = $id;
$this->params['breadcrumbs'][] = ['label' => 'Albums',
    'url' => ['albums','id_user'=>Yii::$app->user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view" xmlns="http://www.w3.org/1999/html">


<div class="container">

    <div class="row-fluid">
        <?php foreach($model as $foto): ?>


            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo $foto->foto_path;   ?>" class="img-rounded" >
                    <div class="caption">
                        <h3><?php echo $foto->namefoto;  ?></h3>
                        <p><?php echo $foto->deskfoto ?></p>

                        <!--<div class="label label-success ">
                            <span class="glyphicon glyphicon-teg"> удалить</span>
                        </div>-->

                    </div>
                </div>
            </div>





        <?php   endforeach ;         ?>

    </div >

</div>
    <?= Html::a('Добавить ', ['fotoform', 'id_album'=>$id], ['class' => 'btn btn-primary']) ;?>

    <?=LinkPager::widget(['pagination'=>$pagination])?>

</div>

