<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesiones */

$this->title = 'Update Profesiones: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<main class="profesiones-update container">

    <div class="row">
        <div class="col-12 shadow p-3">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>


</main>
