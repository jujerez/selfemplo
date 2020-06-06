<?php

use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

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

$url = Url::to(['profesionales/poblaciones']);


$js2 = <<<EOT

    $('#profesionales-provincia').on('change', function(e) {
        var provincia_id = $(this).val();
        
        $.ajax({
            method: 'GET',
            url: '$url',
            data: {
                provincia_id: provincia_id
            },
            success: function (data, code, jqXHR) {
                var selec = $('#profesionales-poblacion_id');
                selec.empty();
                for (var i in data) {
                    selec.append(`<option value="\${i}">\${data[i]}</option>`);
                    
                }
            }   
        });
    });

    
    
 EOT;

$this->registerJs($js2, View::POS_END);

$url3 = Url::to(['profesionales/profesiones']);
$js3 = <<<EOT
    
    $('#profesionales-sector').on('change', function(e) {
        var sector_id = $(this).val();
        $.ajax({
            method: 'GET',
            url: '$url3',
            data: {
                sector_id: sector_id
            },
            success: function (data, code, jqXHR) {
                var selec = $('#profesionales-profesion_id');
                selec.empty();
                for (var i in data) {
                    selec.append(`<option value="\${i}">\${data[i]}</option>`);
                    
                }
            }   
        });
    })
EOT;

$this->registerJs($js3, View::POS_END);

?>


<div class="profesionales-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>
        </div>
    </div>



    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presentacion')->textInput(['maxlength' => true, 'placeholder' => 'Por ejemplo: Soy una persona educada, seria y entregada a mi trabajo']) ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'provincia')->widget(Select2::className(), [
                'data' => $provincias,
                'options' => ['placeholder' => 'Selecciona una provincia', 'value' => $model->provinci->id ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'poblacion_id')->widget(Select2::className(), [
                'data' => $poblaciones,
                'options' => ['placeholder' => 'Selecciona una población'],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
        </div>

                        
    </div>
    
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'sector')->widget(Select2::className(), [
                'data' => $sectores,
                'options' => ['placeholder' => 'Selecciona un sector', 'value' => $model->secto->id,],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'profesion_id')->widget(Select2::className(), [
                'data' => $profesiones,
                'options' => ['placeholder' => 'Selecciona una profesión',],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Modificar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
