<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Administrador', 'url' => ['perfil', 'id' => $model->usuario_id] ];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="administradores-perfil container">

   <section class="row">
       <div class="col">
           <h1>Administrador</h1>
            <div class="card-columns">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Mis datos</h3><hr>
                        <p><?= Html::a('Index', ['administradores/index', 'id' => $model->usuario_id], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Modificar', ['administradores/update', 'id' => $model->usuario_id], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Ver', ['administradores/view', 'id' => $model->usuario_id], ['class' =>'text-primary']) ?></p>
                        
                        
                    </div>
                </div>
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Sectores</h3><hr>
                        <p><?= Html::a('Index', ['sectores/index'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Crear', ['sectores/create'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Modificar', ['sectores/update'], ['class' =>'text-primary']) ?></p>     
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Profesiones</h3><hr>
                        <p><?= Html::a('Index', ['profesiones/index'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Crear', ['profesiones/create'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Modificar', ['profesiones/update'], ['class' =>'text-primary']) ?></p>     
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Provincias</h3><hr>
                        <p><?= Html::a('Index', ['provincias/index'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Crear', ['provincias/create'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Modificar', ['provincias/update'], ['class' =>'text-primary']) ?></p>     
                    </div>
                </div>


                

            </div>
       </div>
   </section>

</main>

    

