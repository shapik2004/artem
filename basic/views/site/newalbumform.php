<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;?>

<?php
$this->title = 'Create album';
//$this->params['breadcrumbs'][] = ['label' => 'New album', 'url' => ['new-album']];
$this->params['breadcrumbs'][] = $this->title;




if (Yii::$app->session->hasFlash('success')) {
    echo "<div class='alert alert-success'>" . Yii::$app->session->getFlash('success') . "</div>";

}

?>

<?php $form=ActiveForm::begin();?>
<?=$form->field($model,'name_album'); ?>
<?=$form->field($model,'album_desk')->textArea(['rows'=>6]);?>



<?= Html::submitButton('Принять' ,['class'=>'btn btn-success']);?>
<?php ActiveForm::end(); ?>

