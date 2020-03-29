<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Poblaciones */

$this->title = 'Modificar Población: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Poblaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<main class="poblaciones-update container">
    <div class="row">
            <section class="col-12">
                <div class="p-4 bg-light">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= $this->render('_form', [
                        'model' => $model,
                        'provincias' => $provincias
                    ]) ?>
                </div>
                
            </section>
    </div>


</>
