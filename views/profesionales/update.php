<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */

$this->title = 'Modificar Perfil: ';
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['view', 'id' => $model->usuario_id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="profesionales-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provincias' => $provincias,
        'poblaciones' => $poblaciones,
    ]) ?>

</div>
