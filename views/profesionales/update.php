<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */

$this->title = 'Modificar Perfil: ';
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['view', 'id' => $model->usuario_id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<main class="profesionales-update container">

    <div class="row justify-content-around">
        <div class="col-12 ">

            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                    'provincias' => $provincias,
                    'poblaciones' => $poblaciones,
                    'sectores' => $sectores,
                    'profesiones' => $profesiones,
                ]) ?>
            </div>

        </div>
    </div>


</main>
