<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleos */

$this->title = 'Modificar Empleo: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Empleos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<main class="container empleos-update">

    <div class="row">

        <div class="col-12 shadow p-3">
        
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


</main>
