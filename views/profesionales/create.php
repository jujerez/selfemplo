<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */

$this->title = 'Create Profesionales';
$this->params['breadcrumbs'][] = ['label' => 'Profesionales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="profesionales-create container">

    <div class="row justify-content-around">
        <section class="col-12">

            <div class="p-3 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </section>
    </div>

</main>
