<?php
use yii\helpers\Html;
//$posts = $dataProvider->getModels();
//Yii::debug($posts);
?>


<div class="row">
    <div class="col-12">
        <div class="card shadow  p-4 mb-2">
         
            <div class="text-left p-2"><strong class="text-success text-left"><?= Html::encode($model->profesion->pronom) ?></strong></div> 
             
            <h3><?=$model->titulo?></h3>
            <p class="card-text mb-auto"><?= Html::encode($model->descripcion) ?></p>
            <p class="card-text mb-auto text-black-50">Ubicación: <b><?= Html::encode($model->poblacion->nombre) ?></b></p>
            
            <div class="pt-3">

                <?=Html::a('Ver', ['empleos/view', 'id' => $key], ['class' => 'btn btn-sm btn-warning'])?>
                <?=Html::a('Enviar presupuesto', ['libros/view', 'id' => $key], ['class' => 'btn btn-sm btn-success'])?>
            </div>


            <div class="card-footer mt-3">
                <span class="float-right text-muted"><?=Yii::$app->formatter->asDate($model->created_at)?></span>
                <span class="text-muted"><i class="fa fa-home"></i>Publicado por: <?= Html::encode($model->nombre)?></span>             
            </div>
        </div>
    </div>
</div>