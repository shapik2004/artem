<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;?>

<?php

$this->title = 'Add foto to '.$id_album.' album';
$this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->session->hasFlash('success')){
    echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('success')."</div>";
}
?>

<?php $form=ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
<?=$form->field($model,'name'); ?>

<?=$form->field($model,'desk')->textArea(['rows'=>6]);?>
<?=$form->field($model,'file')->fileInput(); ?>


<?= Html::submitButton('Принять' ,['class'=>'btn btn-success']);?>
<?php ActiveForm::end(); ?>
