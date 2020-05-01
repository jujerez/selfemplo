<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Votos */
/* @var $form yii\bootstrap4\ActiveForm */


?>
<style>

.panel {
    box-shadow: 0 2px 0 rgba(0,0,0,0.075);
    border-radius: 0;
    border: 0;
    margin-bottom: 24px;
}


.widget-header {
    padding: 15px 15px 50px 15px;
    min-height: 125px;
    position: relative;
    overflow: hidden;
}

.widget-body {
    padding: 50px 15px 15px;
    position: relative;
}
.panel-body {
    padding: 25px 20px;
}

.widget-img {
   
    margin-top: -125px;
} 

</style>
<div class="votos-form">

    <div class="row  justify-content-center ">
        <div class="col-md-6">
            <div class="panel shadow">
                <div class="widget-header bg-primary"></div>
                <div class="widget-body text-center">
                    <div class="img-perfil">

                        <img alt="Profile Picture" class="widget-img " src="https://bootdey.com/img/Content/avatar/avatar1.png">
                    </div>
                <h4><?= $profesional->nombre ?></h4>
                <p class="text-muted">Profesional</p>
            
                <div class="pt-2 pb-2">
                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'voto')->textInput() ?>

                        <?= $form->field($model, 'profesional_id')->hiddenInput(['value'=> $profesional->usuario_id])->label(false) ?>

                        <?= $form->field($model, 'empleador_id')->hiddenInput(['value'=> Yii::$app->user->identity->id])->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Votar', ['class' => 'btn btn-success']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
