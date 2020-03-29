<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Poblaciones */

$this->title = 'Crear Población';
$this->params['breadcrumbs'][] = ['label' => 'Poblaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="poblaciones-create container">
    <div class="row">
        <section class="col-12">

            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                    'provincias' => $provincias,
                ]) ?>
            </div>
            
        </section>
    </div>


</main>
