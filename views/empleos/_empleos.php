<?php
use yii\helpers\Html;
//$posts = $dataProvider->getModels();
//Yii::debug($posts);
?>


<div class="row">
    <div class="col-12">
        <div class="card shadow  p-4 mb-2">
         
            <div class="text-left p-2"><strong class="text-success text-left"><?=$model->titulo?></strong></div> 
             
            <h3><?=$model->titulo?></h3>
            <p class="card-text mb-auto">Isbn: <?=$model->titulo?></p>
            <p class="card-text mb-auto">Numero de paginas: <?=$model->titulo?></p>
            <div class="p-2">

                <?=Html::a('Ver', ['libros/view', 'id' => $key], ['class' => 'btn btn-sm btn-info'])?>
            </div>
            <div class="text-muted text-right p-2"><?=Yii::$app->formatter->asDatetime($model->created_at)?></div>  
        </div>
    </div>
</div>