<?php

use app\models\Empleos;
use app\models\Sectores;
use app\models\SectoresSearch;
use app\models\Usuarios;
use kartik\tabs\TabsX;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
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
                        ['administradores/update', 'id' => $model->usuario_id], 
                        ['class' =>'btn btn-sm btn-primary w-100']) 
                    ?>
                </p>
                
                <p><?=Html::a('Eliminar mi cuenta', 
                        ['delete', 'id' => $model->usuario_id],
                        ['class' => 'btn btn-sm btn-danger w-100 ', 
                            'data' => [
                                'confirm' => '¿Seguro que desea eliminar su cuenta?, se eliminarán todos los datos relacionados con su cuenta',
                                'method' => 'post',
                            ],
                        ])
                    ?>
                </p>
            </div>
        </aside>

       <div class="col-md-9 col-sm-12">
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                        id="sector-tab" 
                        data-toggle="tab" 
                        href="#sector" 
                        role="tab" 
                        aria-controls="sector" 
                        aria-selected="false">
                        <i class="far fa-clipboard"></i> Sectores
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" 
                        id="profesiones-tab" 
                        data-toggle="tab" 
                        href="#profesiones" 
                        role="tab" 
                        aria-controls="profesiones" 
                        aria-selected="false">
                        <i class="far fa-clipboard"></i> Sectores
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
                            <p><strong>Rol:</strong> Administrador</p>         
                        </div>
   
                    </div>

                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Información Personal
                        </div>
                            
                        <div class="card-body bg-light">
                                <p><strong>Nombre:</strong> <?= Html::encode( $model->nombre) ?></p>
                                <p><strong>Apellidos:</strong> <?= Html::encode($model->apellidos) ?></p>
                                <p><strong>Teléfono:</strong> <?= Html::encode($model->telefono) ?></p>
                                <p><strong>Dirección:</strong> <?= Html::encode($model->direccion) ?></p>
                                <p><strong>Fecha alta:</strong> <?= Yii::$app->formatter->asDate($model->created_at)?></p>
                                <p><strong>Población:</strong> <?= Html::encode($model->poblacion->nombre) ?></p>
                                <p><strong>Provincia:</strong> <?= Html::encode($model->provincia->nombre) ?></p>                                        
                        </div>
   
                    </div>
                </div>
               <!--Tab Sectores-->
                <div class="tab-pane fade" id="sector" role="tabpanel" aria-labelledby="sector-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Opciones sectores
                        </div>
                            
                        <div class="card-body bg-light">
                        <p>
                            <?= Html::a('Crear sector', ['sectores/create'], ['class' => 'btn btn-success']) ?>
                        </p>   
                            <?php
                              
                                $dataProvider->pagination = ['pageSize' => 5];
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        'secnom',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => ' {update} {delete}',
                                            'controller' => 'sectores',
                                            'buttons' => [
                                                
                                                'update' => function ($url, $model, $key) {
                                                    return Html::a('Modificar', ['sectores/update', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-warning',
                                                        'style' => ['font-size'=>'10px'],
                                                        
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                    Yii::debug($url);
                                                    return Html::a('Eliminar', $url,[
                                                        'class' => 'btn btn-sm btn-danger',
                                                        'style' => ['font-size'=>'12px'],
                                                        'data-method' => 'POST',
                                                        'data-confirm' => '¿Está seguro que quiere elimnar este sector?',
                                                    ]);
                                                },

                                            ],
                                        ],
                                    ],
                                ]); 
                                Pjax::end();
                            ?>   
                        </div>
   
                    </div>     
                </div>
                <!--Tab Profesiones-->
                <div class="tab-pane fade" id="profesiones" role="tabpanel" aria-labelledby="profesiones-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Sectores
                        </div>
                            
                        <div class="card-body bg-light">
                        <p>
                            <?= Html::a('Crear profesión', ['profesiones/create'], ['class' => 'btn btn-success']) ?>
                        </p>   
                            <?php
                              
                                $dataProvider->pagination = ['pageSize' => 5];
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        'secnom',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view} {update} {delete}',
                                            'buttons' => [
                                                'view' => function ($url, $model, $key) {
                                                    return Html::a('Ver', ['profesiones/view', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-info',
                                                        'style' => ['font-size'=>'10px'],
                                                        
                                                    ]);
                                                },

                                                'update' => function ($url, $model, $key) {
                                                    return Html::a('Modificar', ['profesiones/update', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-warning',
                                                        'style' => ['font-size'=>'10px'],
                                                        
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                    return Html::a('Eliminar', ['profesiones', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-danger',
                                                        'style' => ['font-size'=>'12px'],
                                                        'data-method' => 'POST',
                                                        'data-confirm' => '¿Está seguro que quiere elimnar esta profesión?',
                                                    ]);
                                                },

                                            ],
                                        ],
                                    ],
                                ]); 
                                Pjax::end();
                            ?>   
                        </div>
   
                    </div>     
                </div>
                <!---->
            </div>                                    
        </aside> 
    </section>
</main>

    









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

                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h3>Poblaciones</h3><hr>
                        <p><?= Html::a('Index', ['poblaciones/index'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Crear', ['poblaciones/create'], ['class' =>'text-primary']) ?></p>
                        <p><?= Html::a('Modificar', ['poblaciones/update'], ['class' =>'text-primary']) ?></p>     
                    </div>
                </div>


                

            </div>
       </div>
   </section>

</main>

    

