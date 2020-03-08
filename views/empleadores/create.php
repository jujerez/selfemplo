<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = 'Create Empleadores';
$this->params['breadcrumbs'][] = ['label' => 'Empleadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleadores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
