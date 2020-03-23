<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['perfil', 'id' => $model->usuario_id] ];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="profesionales-perfil container">

   <section class="row">
       <div class="col">
           <h1>Mi perfil</h1>
            <div class="card-columns">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Mis datos</h3><hr>
                        <p><?= Html::a('Modificar', ['profesionales/update', 'id' => $model->usuario_id], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Ver', ['profesionales/view', 'id' => $model->usuario_id], ['class' =>'text-primary']) ?></p>
                        
                        
                    </div>
                </div>
               

            </div>
       </div>
   </section>

</main>

    

