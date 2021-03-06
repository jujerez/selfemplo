<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ValoracionesSearch */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="valoraciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'voto') ?>

    <?= $form->field($model, 'comentario') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'empleador_id') ?>

    <?php // echo $form->field($model, 'profesional_id') ?>

    <?php // echo $form->field($model, 'presupuesto_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
