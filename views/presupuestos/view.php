<?php

use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Presupuestos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="presupuestos-view container">


    <div class="row">
        <section class="col-12">
            <h2 class="p-2">Presupuesto</h2>
            <div class="card shadow p-4 mb-2 ">
            
                <div class="card-header header-presupuesto p-2 d-flex justify-content-between">
                    <span class="text-left text-muted">
                        <p class="cabecera"> Nombre: <?= Html::a($model->profesional->profesionales->nombre, ['profesionales/perfil-publico', 'id' => $model->profesional_id]) ?></p>
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
                </div>

                <div class="card-footer d-flex justify-content-between mt-3">
                    
                    <span class="total"><strong>TOTAL</strong></span>             
                    <span class="total float-right"><strong><?= Html::encode($model->precio)?> €</strong></span>
                       
                </div>
            </div>
                <p>
                    <?= Html::a(Icon::show('pencil-alt'). '' .' Modificar', ['update', 'id' => $model->id,], ['class' => 'btn btn-sm btn-success']) ?>
                    <?= Html::a(Icon::show('trash-alt'). '' .' Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-danger',
                        'data' => [
                            'confirm' => '¿Estas seguro que deseas eliminar eliminar el presupuesto?',
                            'method' => 'post',
                        ],
                    ]) ?> 
                </p>          
        </section>
    </div>

</main>
