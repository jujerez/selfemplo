<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login container ">
    <div class="row justify-content-center align-items-center">

    
        <div class="col-md-6 col-sm-12 borde-sombreado pt-3 m-3 redondeado gris">
            <div class="col-12">

                <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
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
                        <div class="">
                            <?= $form->field($model, 'recordarme',)->checkbox() ?>

                            <?= Html::submitButton('Entrar', ['class' => 'btn btn-warning w-100', 'name' => 'login-button']) ?>
                        </div>
                        
    
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
            
        </div>
    </div>

  
</div>
