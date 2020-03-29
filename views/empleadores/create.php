<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = 'Create Empleadores';
$this->params['breadcrumbs'][] = ['label' => 'Empleadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="empleadores-create container">
    <div class="row">
        <div class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>

</main>
