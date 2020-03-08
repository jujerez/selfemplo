<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administradores */

$this->title = 'Modificar perfil: ' . $model->usuario_id;
$this->params['breadcrumbs'][] = ['label' => 'Administradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="administradores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
