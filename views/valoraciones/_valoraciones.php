<?php

use kartik\icons\Icon;
use kartik\rating\StarRating;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$imagen = Url::to('@app/web/img/' . $model->profesional_id . '.jpg');
!file_exists($imagen) ? $user = '@web/img/user.png' : $user = '@web/img/'. $model->profesional_id .'.jpg';
$empleador = $model->empleador_id;

$profesional = $model->profesional->profesionales->nombre;
$empleador = $model->empleador->empleadores->nombre;

$media = (new \yii\db\Query())
    ->select('AVG(voto) AS media')
    ->from('valoraciones')   
    ->where(['profesional_id' => $model->profesional_id])
    ->one();

?>

<article class="row">
    <div class="col-12">
    <div class="card shadow p-4 mb-2 ">

         <div class="card-header p-1 bg-white">
         
         <h3><?=$model->presupuesto->empleo->titulo?></h3>
         </div> 
         <div class="card-body">
           
            <div class="row">

                <div class="col-md-2">
                    <div class="img-perfil">
                        <?= Html::img($user, ['alt'=>$profesional, 'class'=> 'perfil']) ?>
                        
                    </div>
                </div>

                <div class="col-md-10">              
                   <p><?= $empleador ?> opina sobre <?= Html::a($profesional, ['profesionales/perfil-publico', 'id' => $model->profesional_id]) ?>:</p>
                   <p><i><?=$model->comentario?></i></p>
                   <p>Puntuación de <?=$empleador?> :
                   <?= StarRating::widget([
                        'name' => 'rating',
                        'value' => $model->voto,
                        'pluginOptions' => [
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                        ],
                    ]) ?>
                   </p>


                   <?php if (Yii::$app->user->identity->rol === '2'): ?>

                    <?= Html::a(Icon::show('trash-alt'). '' .' Eliminar', ['valoraciones/delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Esta seguro que desea eliminar esta valoración?',
                            'method' => 'post',
                        ],
                    ]) ?>
                   <?php endif ?>
                </div>
                    
                

            </div>
         </div>

         <div class="card-footer mt-3 bg-white">
             <span class="text-muted"><?= Icon::show('calendar-alt') . Yii::$app->formatter->asDate($model->created_at)?></span>
            
                          
         </div>
     </div>
    </div>
</article>