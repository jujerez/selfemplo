<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administradores */
/* @var $form yii\bootstrap4\ActiveForm */

    $js = <<<EOT
    document.getElementById('administradores-nombre').value = '';
    document.getElementById('administradores-apellidos').value = '';
    document.getElementById('administradores-telefono').value = ''; 
    EOT;
    if(isset(Yii::$app->request->get()['admin-mod'])) {
    unset(Yii::$app->request->get()['admin-mod']);
    $this->registerJs($js);
    }
?>

<div class="administradores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'poblacion_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Modificar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
