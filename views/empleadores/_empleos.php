<?php

use kartik\icons\Icon;
use yii\bootstrap4\Html;

?>

<div class="row">
    <div class="col-12">
        <div class="card p-4 mb-2 sombra_movil ">
         
            <div class="card-header p-2">
                <span class="text-success ">
                    <?= Html::encode($model->profesion->pronom) ?>
                </span>
                <span class=" text-muted float-right d-none d-sm-none d-md-block">
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
                      
                    <?=Html::a(Icon::show('pencil-alt'). '' .' Modificar', 
                        ['empleos/update', 'id' => $key,],
                        ['class' => 'btn btn-sm btn-primary']
                    )?>
                        
                    <?=Html::a(Icon::show('trash-alt'). '' .' Eliminar', 
                        ['empleos/delete', 'id' => $model->id],
                        ['class' => 'btn btn-sm btn-danger', 
                            'data' => [
                                'confirm' => '¿Seguro que desea borrar este empleo?',
                                'method' => 'post',
                            ],
                        ]
                    )?>
                            
                </div>

                <div class="card-footer mt-3">
                <span class="float-right text-muted"><?= Icon::show('calendar-alt') . Yii::$app->formatter->asDate($model->created_at)?></span>
                            
            </div>
            </div>

        </div>
    </div>
</div>