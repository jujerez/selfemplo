<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<EOT
        
    $('.col-sm-10').removeClass('offset-sm-2');
    
EOT;

$this->registerJs($js);
?>
<div class="site-login container ">
    <div class="row justify-content-center align-items-center">

    
        <div class="col-md-6 col-sm-12 borde-sombreado pt-3 m-3 bg-light">
            <div class="col-12 p-4">
                <div class="text-center pb-2">
                <?=Html::img('@web/img/logo-login.png', ['class' => [''], 'alt' => 'Logotipo'])?>
                </div>

                <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
                <hr>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    
                    'fieldConfig' => [
                        'horizontalCssClasses' => ['wrapper' => 'col-12'],
                        
                    ],
                ]); ?>
                    <div class="form-group">

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Usuario') ?>
                    </div>

                    <div class="form-group">
                                                        
                         <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>
            
                    </div>
                    
                    <div class="form-group">
                        
                        <?= $form->field($model, 'recordarme',)->checkbox() ?>

                        <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
                        
                    </div>

                    <p><?=Html::a('Registrarme ahora',Url::to(['usuarios/registrar']))?></p>

                <?php ActiveForm::end(); ?>
            </div>
            
        </div>
    </div>

  
</div>
