<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Poblaciones */

$this->title = 'Crear Población';
$this->params['breadcrumbs'][] = ['label' => 'Poblaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poblaciones-create container">
    <div class="row">
        <section class="col-12 shadow p-3">
            
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
                'provincias' => $provincias,
            ]) ?>
        </section>
    </div>


</div>
