<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesiones */

$this->title = 'Crear Profesiones';
$this->params['breadcrumbs'][] = ['label' => 'Profesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="profesiones-create container">

    <div class="row">
        <section class="col-12 shadow p-3">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
                'sectores' => $sectores,
            ]) ?>
        </section>
    </div>


</main>