<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */
/* @var $form yii\bootstrap4\ActiveForm */

    $js = <<<EOT
        
        document.getElementById('empleadores-apellidos').value = '';
        document.getElementById('empleadores-telefono').value = ''; 
    EOT;
    if(isset(Yii::$app->request->get()['emple-mod'])) {
        unset(Yii::$app->request->get()['emple-mod']);
        $this->registerJs($js);
    }

    $url = Url::to(['empleadores/poblaciones']);
    $js2 = <<<EOT

        

        $('#empleadores-provincia').on('change', function(e) {
            var provincia_id = $(this).val();
            $.ajax({
                method: 'GET',
                url: '$url',
                data: {
                    provincia_id: provincia_id
                },
                success: function (data, code, jqXHR) {
                    var selec = $('#empleadores-poblacion_id');
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

<div class="empleadores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->dropDownList($provincias) ?>

    <?= $form->field($model, 'poblacion_id')->dropDownList($poblaciones) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
