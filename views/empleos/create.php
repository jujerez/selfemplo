<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleos */

$this->title = 'Publicar Empleo';
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['empleadores/perfil', 'id' => Yii::$app->user->identity->id] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="empleos-create container">
    <div class="row">

        <section class="col-12">

            <div class="p-4 bg-light">

                <h1 class="text-center"><?= Html::encode($this->title) ?></h1><hr>

                <?= $this->render('_form', [
                    'model' => $model,
                    'provincias' => $provincias,
                    'poblaciones' => $poblaciones,
                    'sectores' => $sectores,
                    'profesiones' => $profesiones,
                ]) ?>
            </div>

        </section>
    </div>

</main>
