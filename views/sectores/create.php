<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sectores */

$this->title = 'Crear Sector';
$this->params['breadcrumbs'][] = ['label' => 'Sectores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="container sectores-create">

    <div class="row">
        <section class="col-12 p-3 shadow">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </section>
    </div>

    
</main>
