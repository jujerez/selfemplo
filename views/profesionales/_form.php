<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */
/* @var $form yii\bootstrap4\ActiveForm */

$js = <<<EOT
    document.getElementById('profesionales-nombre').value = '';
    document.getElementById('profesionales-apellidos').value = '';
    document.getElementById('profesionales-telefono').value = ''; 
EOT;
if(isset(Yii::$app->request->get()['pro-mod'])) {
    unset(Yii::$app->request->get()['pro-mod']);
    $this->registerJs($js);
}
?>

<div class="profesionales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poblacion_id')->textInput() ?>

    <?= $form->field($model, 'profesion_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
