<?php

use kartik\money\MaskMoney;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Presupuestos */
/* @var $form yii\bootstrap4\ActiveForm */

$empleo_id = Yii::$app->request->get('id');
?>

<div class="presupuestos-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'duracion_estimada')->widget(MaskMoney::classname(), [ 

        'options' => [
            'placeholder' => 'Precio final'
        ],
        'pluginOptions' => [
            'prefix' => 'Horas: ',
            'suffix' => ' h',
            'thousands' => '.',
            'decimal' => ',',
            'precision' => 1
        ],

    ]);
    ?> 
    <?= $form->field($model, 'detalles')->textarea(
        [
            'spellcheck' => true, 
            'placeholder' => 'Describa su presupuesto lo más detallado posible',
            'rows' => '10'
        ]) 
    ?>
    <?= $form->field($model, 'precio')->widget(MaskMoney::classname(), [    
        'pluginOptions' => [
            'prefix' => 'Total: ',
            'suffix' => ' €',
            'thousands' => '.',
            'decimal' => ',',
            'precision' => 2,
            'allowNegative' => false,
        ],
    
        ]);
    ?>
    
  
  
    <?= $form->field($model, 'profesional_id')->hiddenInput(['value'=> Yii::$app->user->identity->id])->label(false) ?>

    <?= $form->field($model, 'empleo_id')->hiddenInput(['value' => $empleo_id,])->label(false) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewrecord ? 'Enviar' : 'Modificar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

   

</div>
