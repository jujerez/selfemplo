<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Presupuestos */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="presupuestos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <?= $form->field($model, 'duracion_estimada')->textInput() ?>

    <?= $form->field($model, 'estado')->checkbox() ?>

    <?= $form->field($model, 'profesional_id')->textInput() ?>

    <?= $form->field($model, 'empleo_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
