<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PresupuestosSearch */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="presupuestos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'precio') ?>

    <?= $form->field($model, 'duracion_estimada') ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

    <?= $form->field($model, 'profesional_id') ?>

    <?php // echo $form->field($model, 'empleo_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
