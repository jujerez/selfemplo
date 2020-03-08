<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */

$this->title = 'Modificar Perfil: ';
$this->params['breadcrumbs'][] = ['label' => 'Profesionales', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="profesionales-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
