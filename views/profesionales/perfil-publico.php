<?php

use app\models\Empleos;
use app\models\Presupuestos;
use app\models\Votos;
use kartik\file\FileInput;
use kartik\icons\Icon;
use kartik\rating\StarRating;
use kartik\tabs\TabsX;
use yii2mod\google\maps\markers\GoogleMaps;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
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

$num_val = Votos::find()->where(['profesional_id' => $model->usuario_id])->count();

$media = (new \yii\db\Query())
    ->select('AVG(voto) AS media')
    ->from('votos')   
    ->where(['profesional_id' => $model->usuario_id])
    ->one();



?>
  
<main class="empleadores-view container">

   <section class="row justify-content-around">
       <aside class="col-md-4 col-sm-12 col-lg-4">
            <div class="sidebar shadow p-4 ">
                <div class="img-perfil text-center p-3">
                <?= Html::img($user, ['alt'=>$model->nombre, ]) ?>
                <h3 class="text-center "><?=$model->nombre?></h3>
                <span class="text-muted">Es de <?=$model->poblacion->nombre?></span><br>
                <span class="text-muted">Registrado el  <?= Yii::$app->formatter->asDate($model->created_at)?></span><br>
                <?= $num_val . ($num_val > 1 ? ' valoraciones' : ' valoración') . StarRating::widget([
                    'name' => 'rating',
                    'value' => $media['media'],
                    'pluginOptions' => [
                        'readonly' => true,
                        'showClear' => false,
                        'showCaption' => false,
                    ],
                ]) ?>
                </div>
                <div class="text-center pt-5">

                    <?= Html::a('Solicitar servicio', ['empleos/create',], 
                        ['class' => 'btn btn-lg btn-primary']) 
                    ?>
                </div>    
            </div>

        </aside>

       <section class="col-md-8 col-sm-12 col-lg-8">
           <article class="presentacion">
               <h2>Así es <?=$model->nombre?></h2>
               <p class="borde-gris p-3"><?= $model->presentacion ?: 'Este usuario todavia no ha puesto su carta de presentación' ?> </p> 
           </article>
           <article class="area-trabajo pt-5">
                <h2><i class="fas fa-map-marked-alt"></i> Mi area de trabajo</h2>
                <div id="map">

                    <?= GoogleMaps::widget([
                           
                        'wrapperHeight' => '350px',

                        'userLocations' => [
                            [
                                'location' => [
                                    'address' => '',
                                    'country' => $model->poblacion->nombre
                                ],      
                            ],
                            
                        ],
   
                    ])?>
                </div>
           </article>
                                        
        </section> 
    </section>
</main>

    

