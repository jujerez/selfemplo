<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sectores */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="sectores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'secnom')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
