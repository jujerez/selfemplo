<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmpleosSearch */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="col-12 card shadow p-3">
    <div class="empleos-search">
    <h4 style="border-bottom: 1px solid #ccc; padding:0.5em">Filtros</h4>
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>


        <?= $form->field($model, 'titulo') ?>

        <?= $form->field($model, 'descripcion') ?>

        <?= $form->field($model, 'created_at')->label('Fecha de publicación') ?>

        <?= $form->field($model, 'poblacion.nombre') ?>
        <?= $form->field($model, 'poblacion.provincia.nombre')->label('Provincia') ?>

        <?php echo $form->field($model, 'empleador.nombre')->label('Autor publicación') ?>

        <?php echo $form->field($model, 'profesion.pronom')->label('Profesión') ?>

        <div class="form-group">
            <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Limpiar', ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>