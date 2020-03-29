<?php

use kartik\icons\Icon;
use yii\helpers\Html;
//$posts = $dataProvider->getModels();
//Yii::debug($posts);
?>


<div class="row">
    <div class="col-12">
        <div class="card shadow p-4 mb-2 ">
         
            <div class="card-header p-2">
                <span class="text-success ">
                    <?= Html::encode($model->profesion->pronom) ?>
                </span>
                <span class=" text-muted float-right">
                    <?= Html::encode($model->profesion->sector->secnom) ?>
                </span>
            </div> 
            <div class="card-body">
 
                <h3><?=$model->titulo?></h3>
                <p class="card-text mb-auto"><?= Html::encode($model->descripcion) ?></p>
                <p class="card-text mb-auto text-black-50">
                     <?=Icon::show('map-marker-alt') . Html::encode($model->poblacion->nombre).', '. 
                        Html::encode($model->poblacion->provincia->nombre) ?>
                    
                </p>
                
                <div class="pt-3">
                
                    <?=Html::a('Enviar presupuesto', ['presupuestos/create', 'id' => $key], ['class' => 'btn btn-sm btn-success'])?>
                    <?php if(!Yii::$app->user->isGuest): 
                            if (Yii::$app->user->identity->rol == '1' && Yii::$app->user->identity->nombre == $model->empleador->nombre):?>
                                <?=Html::a('Modificar', 
                                    ['empleos/update', 'id' => $key, 'idu' => Yii::$app->user->identity->id],
                                    ['class' => 'btn btn-sm btn-warning']
                                )?>
                        

                                <?=Html::a('Borrar', 
                                    ['delete', 'id' => $model->id],
                                    ['class' => 'btn btn-sm btn-danger', 
                                        'data' => [
                                            'confirm' => '¿Seguro que desea borrar este empleo?',
                                            'method' => 'post',
                                        ],
                                    ]
                                )?>
                            <?php endif ?>
                    <?php endif ?>

                </div>
            </div>


            <div class="card-footer mt-3">
                <span class="float-right text-muted"><?= Icon::show('calendar-alt') . Yii::$app->formatter->asDate($model->created_at)?></span>
                <span class="text-muted"><i class=""></i>Publicado por: <?= Html::encode($model->nombre)?></span>             
            </div>
        </div>
    </div>
</div>