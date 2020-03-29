<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = 'Modificar perfil';
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['perfil', 'id' => $model->usuario_id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<main class="empleadores-update container">
    <div class="row">
        <section class="col-12">
            <div class="p-4 bg-light">

                <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                    'provincias' => $provincias,
                    'poblaciones' => $poblaciones,
                ]) ?>
            </div>
        </section>
    </div>


</main>
