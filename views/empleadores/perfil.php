<?php

use app\models\Empleos;
use kartik\tabs\TabsX;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['perfil', 'id' => $model->usuario_id] ];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

  
<main class="empleadores-view container">

   <section class="row justify-content-around">
       <aside class="col-md-3 col-sm-12 ">
            <div class="sidebar bg-light p-4 borde">
                <div class="img-perfil text-center p-3">
                <?= Html::img('@web/img/user.png', ['alt'=>$model->nombre, ]) ?>
                </div>
                <h3 class="text-center "><?=$model->nombre?></h3><hr>
                <p><?= Html::a('Modificar', 
                        ['empleadores/update', 'id' => $model->usuario_id], 
                        ['class' =>'btn btn-sm btn-primary w-100']) 
                    ?>
                </p>
                
                <p><?=Html::a('Eliminar mi cuenta', 
                        ['delete', 'id' => $model->usuario_id],
                        ['class' => 'btn btn-sm btn-danger w-100 ', 
                            'data' => [
                                'confirm' => '¿Seguro que desea borrar este empleo?',
                                'method' => 'post',
                            ],
                        ])
                    ?>
                </p>
            </div>
        </aside>

       <div class="col-md-9 col-sm-12">
            
            <ul class="nav nav-tabs" id="myTab" role="tablist" aria-orientation="vertical">
                <li class="nav-item">
                    <a class="nav-link active" 
                       id="home-tab" 
                       data-toggle="tab" 
                       href="#perfil" 
                       role="tab" 
                       aria-controls="perfil" 
                       aria-selected="true">
                       <i class="fas fa-user"></i> Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" 
                        id="profile-tab" 
                        data-toggle="tab" 
                        href="#profile" 
                        role="tab" 
                        aria-controls="profile" 
                        aria-selected="false">
                        <i class="far fa-clipboard"></i> Empleos
                    </a>
                </li>
               
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Información Cuenta
                        </div>
                            
                        <div class="card-body bg-light">
                                <p><strong>Usuario:</strong> <?= $model->usuario->nombre?></p>
                                <p><strong>Email:</strong> <?= $model->usuario->email?></p>
                                <p><strong>Rol:</strong> Empleador</p>
                                
                                
                        </div>
   
                    </div>

                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Información Personal
                        </div>
                            
                        <div class="card-body bg-light">
                                <p><strong>Nombre:</strong> <?= Html::encode( $model->nombre) ?></p>
                                <p><strong>Apellidos:</strong> <?= Html::encode($model->apellidos) ?></p>
                                <p><strong>Telefono:</strong> <?= Html::encode($model->telefono) ?></p>
                                <p><strong>Dirección:</strong> <?= Html::encode($model->direccion) ?></p>
                                <p><strong>Fecha alta:</strong> <?= Yii::$app->formatter->asDate($model->created_at)?></p>
                                <p><strong>Poblacion:</strong> <?= Html::encode($model->poblacion->nombre)?></p>
                                <p><strong>Provincia:</strong> <?= Html::encode($model->provinci->nombre) ?></p>
                                         
                        </div>
   
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card mb-4">
                            <div class="card-header gris text-white">
                                Mis empleos publicados
                            </div>
                                
                            <div class="card-body bg-light">
                            <?php
                            $dataProvider = new ActiveDataProvider([
                                'query' => Empleos::find()
                                ->where(['empleador_id' => $model->usuario->id]),
                            ]);
                           
                            $dataProvider->pagination = ['pageSize' => 5];
                            Pjax::begin();
                            echo ListView::widget([
                              'dataProvider' => $dataProvider,
                              'summary' => '',
                              'itemView' => '_empleos',
                              'layout' => '{items}
                              
                                <div class="row">
                                    <div class="col-12">
                                        {pager}
                                    </div>
                                </div>
                              
                              ',
                          ]);
                          Pjax::end();
                          ?>
                                        
                            </div>
    
                        </div>
                    </div>
                </div>
                <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">asdcasdc</div> -->
            </div>
   
          
            
       </aside> 
   </section>

</main>

    

