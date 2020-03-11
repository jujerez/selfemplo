<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */
/* @var $form yii\bootstrap4\ActiveForm */

$js = <<<EOT
    
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
    })


EOT;
//$this->registerJs($js2, View::POS_LOAD);
$this->registerJs($js2, View::POS_END);
//$this->registerJs($js2, View::POS_READY);
//$this->registerJs($js2);
?>

<div class="profesionales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->dropDownList($provincias) ?>

    <?= $form->field($model, 'poblacion_id')->dropDownList($poblaciones) ?>

    <?= $form->field($model, 'profesion_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
