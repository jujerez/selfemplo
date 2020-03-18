<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesiones */

$this->title = 'Modificar profesiones: ' . $model->pronom;
$this->params['breadcrumbs'][] = ['label' => 'Profesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pronom, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<main class="profesiones-update container">

    <div class="row">
        <div class="col-12 shadow p-3">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
                'sectores' => $sectores,
            ]) ?>
        </div>
    </div>


</main>
