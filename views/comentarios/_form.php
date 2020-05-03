<?php

use kartik\rating\StarRating;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Votos */
/* @var $form yii\bootstrap4\ActiveForm */

$imagen = Url::to('@app/web/img/' . $profesional->usuario_id . '.jpg');
!file_exists($imagen) ? $user = '@web/img/user.png' : $user = '@web/img/'. $profesional->usuario_id .'.jpg';
$empleador = Yii::$app->user->identity->id;


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

<div class="votos-form mod">

    <div class="row  justify-content-center ">
        <div class="col-md-6">
            <div class="panel shadow modal-contenido">
                <div class="widget-header bg-primary"></div>
                <div class="widget-body text-center">
                    <div class="img-perfil wow zoomIn">
                        <?= Html::img($user, ['alt'=>$profesional->nombre, 'class'=> 'widget-img']) ?>
                       
                    </div>
                <h4><?= $profesional->nombre ?></h4>
                <p class="text-muted">Profesional</p>
            
                <div class="pt-2 pb-2">
                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'texto')->textArea([
                            'maxlength' => true,
                            'spellcheck' => true,  
                            'placeholder' => 'Sea breve y conciso',
                            'rows' => '3'
                            ]) ?>

                        <?= $form->field($model, 'profesional_id')->hiddenInput(['value'=> $profesional->usuario_id])->label(false) ?>

                        <?= $form->field($model, 'empleador_id')->hiddenInput(['value'=> $empleador])->label(false) ?>

                        <?= $form->field($model, 'presupuesto_id')->hiddenInput(['value'=> $presupuesto])->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Comentar', ['class' => 'btn btn-success']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>


                </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

