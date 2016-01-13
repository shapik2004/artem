<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => "LOGO's",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',

        ],
    ]);
    $menu_items=[ ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Аbout', 'url' => ['/site/about']],
       // ['label' => 'contacts', 'url' => ['/site/contact']]
    ];
    if(Yii::$app->user->isGuest):
        $menu_items[]=['label'=>'Регистрация',
                        'url'=>['/site/userform']];
        $menu_items[]=['label'=>'Войти',
                        'url'=>['/site/login']];
    else:
        $menu_items[]=['label' => 'New album',
                        'url' => ['/site/new-album','id_user'=>Yii::$app->user->id]];
        $menu_items[]=['label' => 'Albums',
                        'url' => ['/site/albums','id_user'=>Yii::$app->user->id]];

        $menu_items[]=[

                        'label' => 'Log out "' . Yii::$app->user->identity->name .'"',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']

                        ];

    endif;
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menu_items/* [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'about', 'url' => ['/site/about']],
            ['label' => 'Albums', 'url' => ['/site/albums']],
            ['label' => 'New album', 'url' => ['/site/new-album']],
            ['label' => 'contacts', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/userform']] :
                [

                    'label' => 'Logout (' . Yii::$app->user->identity->name . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],*/
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Артем <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
