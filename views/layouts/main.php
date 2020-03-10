<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap4\Button;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script
			  src="https://code.jquery.com/jquery-3.4.1.slim.js"
			  integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
			  crossorigin="anonymous"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/selfemployed.png', ['alt'=>Yii::$app->name, 'style'=>['height'=>'40px']]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-light bg-light navbar-expand-md shadow fixed-top ',
        ],
        'collapseOptions' => [
            'class' => 'justify-content-end',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],

            Yii::$app->user->isGuest 
            ? (['label' => 'Entrar', 'url' => ['site/login']])
            : '',
            Yii::$app->user->isGuest 
            ? (['label' => 'Registrarse', 'url' => ['usuarios/registrar']])
            : '',

            !Yii::$app->user->isGuest 
            ? 
                (['label' => 'Mi perfil', 
                    'items' => [
                        Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) 
                        : (
                            Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Cerrar sesión (' . Yii::$app->user->identity->nombre . ')',
                                ['class' => 'dropdown-item'],
                            )
                            . Html::endForm()
                            ),

                            (Yii::$app->user->identity->rol == '0') 
                            ? (['label' => 'Modificar mi perfil', 'url' => ['profesionales/update', 'id' => Yii::$app->user->identity->id],])
                            : (['label' => 'Modificar mi perfil', 'url' => ['empleadores/update', 'id' => Yii::$app->user->identity->id],]) ,

                            (Yii::$app->user->identity->rol == '0') 
                            ? (['label' => 'Ver mi perfil', 'url' => ['profesionales/view', 'id' => Yii::$app->user->identity->id],])
                            : (['label' => 'Ver mi perfil', 'url' => ['empleadores/view', 'id' => Yii::$app->user->identity->id],]),

                            (Yii::$app->user->identity->rol == '0') 
                            ? (['label' => 'Ver empleos', 'url' => ['empleos/index'],])
                            : '' ,



            
                
                        ],
                    ])
            : '',
            
        ],
    ]);
    
    NavBar::end();
    ?>

    <div class="container-fluid">
        <div class="container migas">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) 
            ?>
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer bg-dark">
    <div class="container">
        <p class="text-center text-white">&copy; Selfemplo <?= date('Y')?> | Todos los derechos reservados</p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
