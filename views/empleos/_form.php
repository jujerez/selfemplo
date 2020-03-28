<?php

use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Empleos */
/* @var $form yii\bootstrap4\ActiveForm */

$url = Url::to(['empleos/poblaciones']);
$js = <<<EOT
    
    $('#empleos-provincia').on('change', function(e) {
        var provincia_id = $(this).val();
        $.ajax({
            method: 'GET',
            url: '$url',
            data: {
                provincia_id: provincia_id
            },
            success: function (data, code, jqXHR) {
                var selec = $('#empleos-poblacion_id');
                selec.empty();
                for (var i in data) {
                    selec.append(`<option value="\${i}">\${data[i]}</option>`);
                    
                }
            }   
        });
    })
EOT;

$this->registerJs($js, View::POS_END);

$url2 = Url::to(['empleos/profesiones']);
$js2 = <<<EOT
    
    $('#empleos-sector').on('change', function(e) {
        var sector_id = $(this).val();
        $.ajax({
            method: 'GET',
            url: '$url2',
            data: {
                sector_id: sector_id
            },
            success: function (data, code, jqXHR) {
                var selec = $('#empleos-profesion_id');
                selec.empty();
                for (var i in data) {
                    selec.append(`<option value="\${i}">\${data[i]}</option>`);
                    
                }
            }   
        });
    })
EOT;

$this->registerJs($js2, View::POS_END);

$provincia_id = $model->isNewRecord ? '1' : $model->poblacion->provincia->id;
$sector_id = $model->isNewRecord ? '1' : $model->profesion->sector->id;

?>

<div class="empleos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder' => 'Por ejm. Informático a domicilio'], ) ?>


    <?= $form->field($model, 'descripcion')->textarea(
        [
          'spellcheck' => true, 
          'placeholder' => 'Describa su oferta lo más detallada posible',
          'rows' => '10'
          
        ]
    ) ?>
    
    <?= $form->field($model, 'provincia')->widget(Select2::className(), [
            'data' => $provincias,
            'options' => ['placeholder' => 'Selecciona una provincia', 'value' => $provincia_id ],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]); 
    ?>

    <?= $form->field($model, 'poblacion_id')->widget(Select2::className(), [
            'data' => $poblaciones,
            'options' => ['placeholder' => 'Selecciona una población'],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]); 
    ?>


    <?= Html::activeHiddenInput($model, 'empleador_id', ['value' => Yii::$app->user->identity->id]) ?>
    
    <?= $form->field($model, 'sector')->widget(Select2::className(), [
            'data' => $sectores,
            'options' => ['placeholder' => 'Selecciona un sector', 'value' => $sector_id ],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]); 
    ?>

    <?= $form->field($model, 'profesion_id')->widget(Select2::className(), [
            'data' => $profesiones,
            'options' => ['placeholder' => 'Selecciona una profesión',],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]); 
    ?>


    <div class="form-group">
        <?= Html::submitButton('Publicar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
