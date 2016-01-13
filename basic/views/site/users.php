<?php

use yii\helpers\Html;



 $this->title='Пользователи';
 $this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">


        <table class="table">



    <?php foreach($users as $user)
    {

        ?>

        <tr class="active">
            <td >
                <?php echo $user->id?>
            </td>

            <td >
                <?php echo $user->name?>
            </td>
            <td >
                <?php echo  $user->email;?>
            </td>
            <td >
            <?= Html::a('Просмотреть', ['info', 'id'=> $user->id], ['class' => 'btn btn-primary']) ?>

            </td>

            <td >
                <?= Html::a('Редактировать', ['Userupdate', 'id'=> $user->id], ['class' => 'btn btn-primary']) ?>

            </td>
            <td >
                <a href="#"><button type="button" class="btn btn-warning"> Удалить</button></a>
            </td>

        </tr>

    <?php           }               ?>
</table>

<a href="index.php"><button type="button" class="btn btn-primary" name="back">Назад</button></a><br/>
</div>



