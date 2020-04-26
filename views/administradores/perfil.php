<?php

use app\models\Empleos;
use app\models\Sectores;
use app\models\SectoresSearch;
use app\models\Usuarios;
use kartik\file\FileInput;
use kartik\icons\Icon;
use kartik\tabs\TabsX;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['perfil', 'id' => $model->usuario_id] ];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$imagen = Url::to('@app/web/img/' . $model->usuario_id . '.jpg');
!file_exists($imagen) ? $user = '@web/img/user.png' : $user = '@web/img/'. $model->usuario_id .'.jpg'; 
?>
  
<main class="empleadores-view container">

   <section class="row justify-content-around">
       <aside class="col-md-4 col-sm-12 col-lg-3">
            <div class="sidebar bg-light p-4 borde">
                <div class="img-perfil text-center p-3">
                <?= Html::img($user, ['alt'=>$model->nombre, ]) ?>
                </div>
                <h3 class="text-center "><?=$model->nombre?></h3><hr>
                 <!--Formulario modificar una imagen-->
                 <div class="modificar-imagen " >
                    <p class="text-center">Cambiar imagen perfil</p>
                    <?php $form = ActiveForm::begin() ?>      
                    <?= $form->field($model2, 'imagen')->widget(FileInput::classname(), [
                        'options' => [
                            'accept' => 'image/*',
                           
                        ],
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => true,
                            'browseClass' => 'btn btn-sm btn-success',
                            'mainClass' => 'input-group-sm',
                            
                        ]
                        
                        ])->label(false);
                    ?>

                    <?php ActiveForm::end() ?>
                </div><hr>
                <div class="list-group">

                    <?= Html::a(Icon::show('user-cog') .' ' .'Modificar', 
                            ['administradores/update', 'id' => $model->usuario_id], 
                            ['class' =>'list-group-item list-group-item-action']) 
                    ?>
                    
                    
                    <?=Html::a(Icon::show('user-slash') .' ' .'Eliminar mi cuenta', 
                            ['delete', 'id' => $model->usuario_id],
                            ['class' => 'list-group-item list-group-item-action', 
                                'data' => [
                                    'confirm' => '¿Seguro que desea eliminar su cuenta?, se eliminarán todos los datos relacionados con su cuenta',
                                    'method' => 'post',
                                ],
                            ])
                    ?>
                </div>
                
            </div>
        </aside>

       <div class="col-md-8 col-sm-12 col-lg-9">
            
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
                        <i class="fas fa-industry"></i> Sectores
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
                        <i class="fas fa-user-tie"></i> Profesiones
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" 
                        id="provincias-tab" 
                        data-toggle="tab" 
                        href="#provincias" 
                        role="tab" 
                        aria-controls="provincias" 
                        aria-selected="false">
                        <i class="fas fa-city"></i> Provincias
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" 
                        id="poblaciones-tab" 
                        data-toggle="tab" 
                        href="#poblaciones" 
                        role="tab" 
                        aria-controls="poblaciones" 
                        aria-selected="false">
                        <i class="fas fa-building"></i> Poblaciones
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" 
                        id="presupuestos-tab" 
                        data-toggle="tab" 
                        href="#presupuestos" 
                        role="tab" 
                        aria-controls="presupuestos" 
                        aria-selected="false">
                        <i class="far fa-clipboard"></i> Presupuestos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" 
                        id="usuarios-tab" 
                        data-toggle="tab" 
                        href="#usuarios" 
                        role="tab" 
                        aria-controls="usuarios" 
                        aria-selected="false">
                        <i class="fas fa-users"></i> Usuarios
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" 
                        id="mod-emple-tab" 
                        data-toggle="tab" 
                        href="#mod-emple" 
                        role="tab" 
                        aria-controls="mod-emple" 
                        aria-selected="false">
                        <i class="fas fa-check-circle"></i> Moderaciones empleos
                    </a>
                </li>
               
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Tab info-->
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
                            Lista de Sectores
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
                                                        'class' => 'btn btn-sm btn-primary',
                                                        
                                                        
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                   
                                                    return Html::a('Eliminar', $url,[
                                                        'class' => 'btn btn-sm btn-danger',
                                                        
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
                            Lista de Profesiones
                        </div>
                            
                        <div class="card-body bg-light">
                        <p>
                            <?= Html::a('Crear profesión', ['profesiones/create'], ['class' => 'btn btn-success']) ?>
                        </p>   
                            <?php
                              
                                $proDataProvider->pagination = ['pageSize' => 5];
                                Yii::debug($proDataProvider);
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $proDataProvider,
                                    'filterModel' => $proSearchModel,
                                    'columns' => [
                                        'sector.secnom',
                                        'pronom',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update} {delete}',
                                            'controller' => 'profesiones',
                                            'buttons' => [
                                                
                                                'update' => function ($url, $model, $key) {
                                                    return Html::a('Modificar', ['profesiones/update', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-primary',   
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                    return Html::a('Eliminar', $url, [
                                                        'class' => 'btn btn-sm btn-danger',
                                                        'data-method' => 'POST',
                                                        'data-confirm' => '¿Está seguro que quiere eliminar esta profesión?',
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
            
                <!--Tab Provincias-->
                <div class="tab-pane fade" id="provincias" role="tabpanel" aria-labelledby="provincias-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Lista de provincias
                        </div>
                            
                        <div class="card-body bg-light">
                        <p>
                            <?= Html::a('Crear provincia', ['profesiones/create'], ['class' => 'btn btn-success']) ?>
                        </p>   
                            <?php
                              
                                $proDataProvider->pagination = ['pageSize' => 5];
                                Yii::debug($proDataProvider);
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $provDataProvider,
                                    'filterModel' => $provSearchModel,
                                    'columns' => [
                                        
                                        'nombre',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update} {delete}',
                                            'controller' => 'provincias',
                                            'buttons' => [
                                                
                                                'update' => function ($url, $model, $key) {
                                                    return Html::a('Modificar', ['provincias/update', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-primary',   
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                    return Html::a('Eliminar', $url, [
                                                        'class' => 'btn btn-sm btn-danger',
                                                        'data-method' => 'POST',
                                                        'data-confirm' => '¿Está seguro que quiere eliminar esta provincia?',
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
            
                <!--Tab Poblaciones-->
                <div class="tab-pane fade" id="poblaciones" role="tabpanel" aria-labelledby="poblaciones-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Lista de poblaciones
                        </div>
                            
                        <div class="card-body bg-light">
                        <p>
                            <?= Html::a('Crear población', ['poblaciones/create'], ['class' => 'btn btn-success']) ?>
                        </p>   
                            <?php
                              
                                $pobDataProvider->pagination = ['pageSize' => 5];
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $pobDataProvider,
                                    'filterModel' => $pobSearchModel,
                                    'columns' => [
                                        'provincia.nombre',
                                        'nombre',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update} {delete}',
                                            'controller' => 'poblaciones',
                                            'buttons' => [
                                                
                                                'update' => function ($url, $model, $key) {
                                                    return Html::a('Modificar', ['poblaciones/update', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-primary',   
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                    return Html::a('Eliminar', $url, [
                                                        'class' => 'btn btn-sm btn-danger',
                                                        'data-method' => 'POST',
                                                        'data-confirm' => '¿Está seguro que quiere eliminar esta población?',
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
                 <!--Tab Presupuestos-->
                 <div class="tab-pane fade" id="presupuestos" role="tabpanel" aria-labelledby="presupuestos-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Lista de presupuestos
                        </div>
                            
                        <div class="card-body bg-light">
                       
                            <?php
                              
                                $proDataProvider->pagination = ['pageSize' => 5];
                                Yii::debug($proDataProvider);
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $presDataProvider,
                                    'filterModel' => $presSearchModel,
                                    'columns' => [
                                        
                                        'precio',
                                        'duracion_estimada',
                                        
                                        [
                                            'attribute' => 'estado',
                                            'format' => 'text',
                                            'label' => 'Estados',
                                            'value' => function ($model) {
                                                return $model->estado == '0' 
                                                ? 'Rechazado'
                                                : $model->estado == '1' ? 'Aceptado' : 'Pendiente'; 
                                            }
                                            
                                        ], 
                                        'empleo.titulo',
                                        'profesional.profesionales.nombre',
                                        
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update} {delete} {view}',
                                            'controller' => 'presupuestos',
                                            'buttons' => [
                                                
                                                'update' => function ($url, $model, $key) {
                                                    return Html::a('Modificar', ['presupuestos/update', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-primary',   
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                    return Html::a('Eliminar', $url, [
                                                        'class' => 'btn btn-sm btn-danger',
                                                        'data-method' => 'POST',
                                                        'data-confirm' => '¿Está seguro que quiere eliminar esta provincia?',
                                                    ]);
                                                },

                                                'view' => function ($url, $model, $key) {
                                                    return Html::a('Ver', ['presupuestos/view', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-info',   
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

                <!-- Tab usuarios-->
                <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Lista de presupuestos
                        </div>
                            
                        <div class="card-body bg-light">
                       
                            <?php
                              
                                $proDataProvider->pagination = ['pageSize' => 5];
                                Yii::debug($proDataProvider);
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $usuDataProvider,
                                    'filterModel' => $usuSearchModel,
                                    'columns' => [
                                        
                                        'nombre',
                                        'email',
                                        
                                        [
                                            'attribute' => 'banned_at',
                                            'format' => 'text',
                                            'label' => 'Baneado',
                                            'value' => function ($model) {
                                                return $model->banned_at === null
                                                ? 'Activo'
                                                : 'Baneado';
                                            },
                                            'contentOptions'=>function($model, $key, $index, $column) { 

                                                if ($model->banned_at === null) {

                                                    return ['style' => 'color:green'];

                                                } else {
                                                    
                                                    return ['style' => 'color:red'];  
                                                }
                                    
                                            },
                                        ],
                                        [
                                            'attribute' => 'rol',
                                            'format' => 'text',
                                            'label' => 'Rol',
                                            'value' => function ($model) {
                                                return $model->rol == '0' 
                                                ? 'Profesional'
                                                : $model->rol == '1' ? 'Empleador' : 'Administrador'; 
                                            }
                                            
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{banear} {desbanear}',
                                            //'controller' => 'usuarios',
                                            'buttons' => [

                                                'banear' => function ($url, $model, $key) {
                                                    if ($model->banned_at === null) {

                                                        return Html::a(Icon::show('user-ninja'). '' .'Banear', ['usuarios/banear', 'id' => $key], [
                                                            'class' => 'btn btn-sm btn-danger',   
                                                        ]);
                                                    }
                                                },
                                        
                                                
                                                'desbanear' => function ($url, $model, $key) {
                                                    if ($model->banned_at !== null) {
                                                        return Html::a(Icon::show('check-circle'). '' .'Activar', ['usuarios/desbanear', 'id' => $key], [
                                                            'class' => 'btn btn-sm btn-primary',
                                                        ]);
                                                    }
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
                <!-- Tab moderaciones empleos-->
                <div class="tab-pane fade" id="mod-emple" role="tabpanel" aria-labelledby="mod-emple-tab">
                    <div class="card mb-4">
                        <div class="card-header gris text-white-50">
                            Lista de empleos a moderar
                        </div>
                            
                        <div class="card-body bg-light">
                       
                            <?php
                              
                                $query = Empleos::find()->where(['moderado' =>  false]);

                                $dataProvider = new ActiveDataProvider([
                                    'query' => $query,
                                ]);
                        
                                $dataProvider->setSort([
                                    'defaultOrder' => ['created_at' => SORT_DESC],
                                ]);

                                $dataProvider->pagination = ['pageSize' => 5];
                               
                                Pjax::begin();
                                echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    //'filterModel' => $SearchModel,
                                    'columns' => [
                                        
                                        'titulo',
                                        'descripcion',
                                        
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{validar} {delete}' ,
                                            'buttons' => [
                                                
                                                'validar' => function ($url, $model, $key) {
                                                    return Html::a('Validar', ['empleos/validar', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-primary', 
                                                        
                                                        'data-confirm' => '¿Está seguro que quiere validar este empleo?',  
                                                    ]);
                                                },

                                                'delete' => function ($url, $model, $key) {
                                                    return Html::a('Eliminar', ['empleos/delete', 'id' => $key], [
                                                        'class' => 'btn btn-sm btn-danger',
                                                        'data-method' => 'POST',
                                                        'data-confirm' => '¿Está seguro que quiere eliminar este empleo?',   
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


    

