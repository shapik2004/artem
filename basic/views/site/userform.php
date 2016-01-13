<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;?>

<?php
$this->title='Регистрация';
$this->params['breadcrumbs'][] = $this->title;
    if (Yii::$app->session->hasFlash('success')){
        echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('success')."</div>";
    }
?>

<?php $form=ActiveForm::begin();?>
<?=$form->field($model,'name'); ?>
<?=$form->field($model,'email'); ?>
<?=$form->field($model,'password')->passwordInput(); ?>



<?= Html::submitButton('Принять' ,['class'=>'btn btn-success']);?>
<?php ActiveForm::end(); ?>
