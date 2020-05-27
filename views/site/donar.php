<?php

use kartik\icons\Icon;
use kartik\money\MaskMoney;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Donar';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="site-donar container">

    <section class="row justify-content-center">
        <div class="col-md-6 p-3 shadow">
            <h1><i class="fab fa-paypal text-primary"></i> Donación PayPal</h1>

            <?php $form = ActiveForm::begin(); ?>
        
             
                <?= $form->field($model, 'cantidad')->widget(MaskMoney::classname(), [ 
        
                    'options' => [
                        'placeholder' => 'Cantidad a donar'
                    ],
                    'pluginOptions' => [
                        'prefix' => 'Euros: ',
                        'suffix' => ' €',
                        'thousands' => '.',
                        'decimal' => ',',
                        'precision' => 1
                    ],
        
                ]);
                ?> 
 
                <div class="form-group">
                    <?= Html::submitButton('<i class="fab fa-paypal" ></i> PayPal Donate', ['class' => 'btn btn-warning']) ?>
                </div>
        
            <?php ActiveForm::end(); ?>
        </div>

    </section>


</main>