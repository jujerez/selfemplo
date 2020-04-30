<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Votos */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="votos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'voto')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'empleador_id')->textInput() ?>

    <?= $form->field($model, 'profesional_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
