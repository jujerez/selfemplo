<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profesiones */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="profesiones-form ">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pronom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sector_id')->dropDownList($sectores) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
