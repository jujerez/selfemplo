<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = 'Modificar perfil';
$this->params['breadcrumbs'][] = ['label' => 'Empleadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="empleadores-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provincias' => $provincias,
        'poblaciones' => $poblaciones,
    ]) ?>

</div>
