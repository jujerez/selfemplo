<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['perfil', 'id' => $model->usuario_id] ];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="empleadores-view container">

   <section class="row">
       <div class="col">
           <h1>Mi perfil</h1>
            <div class="card-columns">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Mis datos</h3><hr>
                        <p><?= Html::a('Modificar', ['empleos/create'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Ver', ['empleos/create'], ['class' =>'text-primary']) ?></p>
                        
                        
                    </div>
                </div>
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Empleos</h3><hr>
                        <p><?= Html::a('Publicar Empleo', ['empleos/create'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Modificar Empleo', ['empleos/update'], ['class' =>'text-primary']) ?></p>
                        
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Presupuestos</h3><hr>
                        <p><?= Html::a('Presupuestos recibidos', ['presupuestos/recibidos'], ['class' =>'text-primary']) ?></p>
                        
                    </div>
                </div>

            </div>
       </div>
   </section>

</main>

    

