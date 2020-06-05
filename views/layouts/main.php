<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;
use app\components\Util;
use kartik\dialog\Dialog;
use kartik\icons\Icon;

AppAsset::register($this);

Icon::map($this); 
use kartik\dialog\DialogAsset;
use rootlocal\widgets\wow\WowWidget;
use yii\helpers\Url;

// DialogAsset::register($this);

$url = Url::to(['site/cookie',  'cadena' => 'politica']);

$js = <<<EOT
    $( document ).ready(function() {
        politica.confirm("Utilizamos cookies para asegurar que damos la mejor experiencia al usuario en nuestra web. Si sigues utilizando este sitio asumiremos que estás de acuerdo.", function (result) {
            if (result) {
                window.location="$url";
            } else {
                window.location="http://google.es";
            }
        });
    });
    
EOT;
if (!isset($_COOKIE['politica'])) {

    $this->registerJs($js);
}


Util::dialogoPolitica();
Util::dialogo();
WowWidget::widget();
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
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet"> 
</head>
<body>
<?php $this->beginBody() ?>




<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/selfemployed.png', ['alt'=>Yii::$app->name, 'style'=>['height'=>'40px']]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-light bg-light navbar-expand-md shadow fixed-top',
        ],
        'collapseOptions' => [
            'class' => 'justify-content-end',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Empleos', 'url' => ['/empleos/index']],
            ['label' => 'Contacto', 'url' => ['/site/contact']],

            Yii::$app->user->isGuest 
            ? (['label' => 'Entrar', 'url' => ['site/login'], 'options' => ['class' => 'entrar']])
            : '',
            Yii::$app->user->isGuest 
            ? (['label' => 'Registrarse', 'url' => ['usuarios/registrar']])
            : '',


            !Yii::$app->user->isGuest 
            ? 
                (['label' => Icon::show('user') . 'Mi perfil', 
                    'items' => [
                        Yii::$app->user->isGuest 
                        ? (['label' => 'Login', 'url' => ['/site/login']]) 
                        : (
                            Html::beginForm(['/site/logout'], 'post')
                            . '<p class=\' dropdown-p\'>Logueado como ' . Yii::$app->user->identity->nombre . '</p>'
                            . '<div class="dropdown-divider"></div>'  
                            . Html::submitButton(
                                Icon::show('sign-out-alt') . 'Cerrar sesión',
                                ['class' => 'dropdown-item'],
                            )
                            . Html::endForm()
                            ),
                           
                            Yii::$app->user->identity->rol == '0'
                            ? (['label' =>  Icon::show('user-cog') . 'Opciones mi perfil', 
                                'url' => ['profesionales/perfil', 'id' => Yii::$app->user->identity->id],])
                            : '',
                            Yii::$app->user->identity->rol == '1'
                            ? (['label' => Icon::show('user-cog') . 'Opciones mi perfil', 
                                'url' => ['empleadores/perfil', 'id' => Yii::$app->user->identity->id],])
                            : '',

                            Yii::$app->user->identity->rol == '2'
                            ? (['label' => Icon::show('user-cog') . 'Opciones administrador', 
                                'url' => ['administradores/perfil', 'id' => Yii::$app->user->identity->id],])
                            : '',
                        ],
                    ])
            : '',
            
        ],
        'encodeLabels' => false
    ]);
  
    NavBar::end();
    ?>

    <div class="container-fluid">
        <div class="container migas ">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) 
            ?>
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer bg-dark mt-3">
    <div class="container">
        <div class="row justify-content-around align-content-center">
            <div class="col-md-12" itemscope itemtype="http://schema.org/Organization">

                <p itemprop="name" class="text-center"> <?=Html::a('<em class="fab fa-paypal" ></em> Donar',Url::to(['site/donar']))?> </p>
                <p itemprop="name" class="text-center text-white">&copy; Selfemplo <?= date('Y')?> | Todos los derechos reservados</p>
                
            </div>
        </div>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
