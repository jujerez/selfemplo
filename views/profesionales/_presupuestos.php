<?php

use kartik\icons\Icon;
use yii\bootstrap4\Html;

?>
<main class="presupuestos-view container">


    <div class="row">
        <section class="col-12">
            <div class="card shadow p-4 mb-2 ">
            <h1 class="presupuesto p-2">Titulo empleo: <?=$model->empleo->titulo?></h1>
            
                <div class="card-header header-presupuesto p-2 d-flex justify-content-between">
                    <span class="text-left text-muted">
                        <p class="cabecera"> Nombre: <?= Html::encode($model->profesional->profesionales->nombre) ?></p>
                        <p class="cabecera"> Telefono: <?= Html::encode($model->profesional->profesionales->telefono) ?></p>
                        <p class="cabecera"> Email: <?= Html::encode($model->profesional->email) ?></p>
                    </span>
                        
                    
                    <span class=" text-muted float-right d-none d-sm-none d-md-block">
                    
                        <p class="cabecera"> Cliente: <?= $model->empleador->nombre?></p>
                        <?= Icon::show('calendar-alt') . Yii::$app->formatter->asDate($model->created_at)?>
                    </span>
                </div> 
                <div class="card-body">
                    <h4>Detalles</h4>
                    <p class="card-text mb-auto"><?= nl2br(Html::encode($model->detalles)) ?></p>
                    <p class="card-text mb-auto">Duración: <?= Html::encode($model->duracion_estimada)?> horas</p>     
                     
                    <?php if($model->estado=='0'):?>
                        <span class="p-2 badge badge-pill badge-danger text-uppercase">Rechazado</span>
                    <?php elseif($model->estado=='1'):?>
                        <span class="p-2 badge badge-pill  badge-success text-uppercase">Aceptado</span>
                    <?php else:?>
                        <span class="p-2 badge badge-pill badge-info text-uppercase">Pendiente</span>

                    <?php endif ?>  
                    </h4>
                    <p class="pt-2">
                        <?= Html::a(Icon::show('pencil-alt'). '' .' Modificar', ['presupuestos/update', 'id' => $model->id,], 
                        ['class' => 'btn btn-sm btn-primary']) ?>
                        
                        
                        <?= Html::a(Icon::show('trash-alt'). '' .' Eliminar', ['presupuestos/delete', 'id' => $model->id], [
                            'class' => 'btn btn-sm btn-danger',
                            
                            'data' => [
                                'confirm' => '¿Estas seguro que deseas eliminar el presupuesto?',
                                'method' => 'post',
                                'controller' => 'presupuestos',
                            ],
                        ]) ?> 
                    </p>    
                </div>


                <div class="card-footer d-flex justify-content-between mt-3">
                    
                    <span class="total"><strong>TOTAL</strong></span>             
                    <span class="total float-right"><strong><?= Html::encode($model->precio)?> €</strong></span>
                       
                </div>
                             
            </div>
        </section>
    </div>

</main>
