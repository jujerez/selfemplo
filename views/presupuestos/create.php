<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Presupuestos */

$this->title = 'Crear Presupuesto';
$this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="presupuestos-create container">

    <div class="row">
        <section class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </section>
    </div>


</div>
