<?php


use yii\helpers\Html;



 $this->title='My Albums';
 $this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">


    <table class="table">



        <?php foreach($albums as $album)
        {

            ?>

            <tr class="active">
                <td >
                    <?php echo $album->name_album?>
                </td>

                <td >
                    <?php echo $album->album_desk?>
                </td>
                <td >
                    <?php echo  $album->date;?>
                </td>
                <td >
                    <?= Html::a('Просмотреть', ['album', 'id'=> $album->id], ['class' => 'btn btn-primary']) ?>

                </td>

                <td >
                    <?= Html::a('Редактировать', ['update', 'id'=> $album->id], ['class' => 'btn btn-primary']) ?>

                </td>
                <td >
                    <?= Html::a('Удалить', ['delete', 'id'=> $album->id], ['class' => 'btn btn-warning']) ?>

                </td>

            </tr>

        <?php } ?>
    </table>

    <a href="index.php"><button type="button" class="btn btn-primary" name="back">Назад</button></a><br/>
</div>



