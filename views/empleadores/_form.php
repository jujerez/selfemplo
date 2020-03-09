<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */
/* @var $form yii\bootstrap4\ActiveForm */

    $js = <<<EOT
        document.getElementById('empleadores-nombre').value = '';
        document.getElementById('empleadores-apellidos').value = '';
        document.getElementById('empleadores-telefono').value = ''; 
    EOT;
    if(isset(Yii::$app->request->get()['emple-mod'])) {
        unset(Yii::$app->request->get()['emple-mod']);
        $this->registerJs($js);
    }
?>

<div class="empleadores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poblacion_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
