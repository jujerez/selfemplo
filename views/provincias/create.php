<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provincias */

$this->title = 'Crear Provincias';
$this->params['breadcrumbs'][] = ['label' => 'Provincias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="provincias-create container">
    <div class="row">
        <section class="col-12 shadow p-3">   

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </section>
    </div>

</div>
