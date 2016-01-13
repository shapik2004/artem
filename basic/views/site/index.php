<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Фотоальбом';
?>
<div class="site-index">

    <div class="jumbotron" style="color: #47a447">
        <h2>Размещайте свои фото</h2>

    </div>




    <div class="body-content">
        <div class="container">
            <div id="carousel-example-generic" class="carousel slide" >
                <!-- Indicators -->

                <!-- Wrapper for slides -->
                <div class="carousel-inner" >
                    <div class="item active">
                        <?=Html::img('upload/img3.jpg')?>

                        <div class="carousel-caption">

                        </div>
                    </div>

                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="row">

        </div>

    </div>
</div>
