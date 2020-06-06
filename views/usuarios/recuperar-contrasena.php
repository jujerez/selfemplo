<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>



<main class="recuperar-contrasena container ">
    <div class="row justify-content-center align-items-center">

    
        <div class="col-md-6 col-sm-12 borde-sombreado pt-3 m-3 bg-light">
            <div class="col-12 p-4">
                <h1 class="text-center">Recuperar Contraseña</h1><hr>

                <div class="p-3">

                    <?php $form = ActiveForm::begin([
                        'action' => ['usuarios/recuperar-contrasena'],
                        
                    ]); ?>
    
                    <div class="form-group w-100 ">
                        
                        <label class="col-12" for="email"> Introduzca su email:</label>
                        <div class="form-group">

                            <?= Html::input('text','email', null ,  ['class' => 'form-group w-100'])?>
                        </div>
                    </div>

                    
    
                    <div class="form-group">
                        <?= Html::submitButton('Recuperar', ['class' => 'btn btn-primary w-100']) ?>
                    </div>
    
                    <?php ActiveForm::end(); ?>
                </div>

            </div>
            
        </div>
    </div>

  
</main>

