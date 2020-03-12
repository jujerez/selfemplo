<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\LinkSorter;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpleosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empleos';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="empleos-index container">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <div class="row">

        <div class="col-md-3 col-sm-12">
             <?php echo $this->render('_search', ['model' => $searchModel]); ?>
             <!-- <div class="shadow p-3 mt-3">
                <h4>Ordenar por titulo</h4>
                <hr>
                <?= LinkSorter::widget([

                    'sort' => $dataProvider->sort,
                    'attributes' => [
                        'titulo',
                        'descripcion',
                        'created_at',
                        'poblacion.nombre',
                        'empleador.nombre',
                        'profesion.pronom',
                        
                    ],
                    

                ]) ?>
             </div> -->
        </div>

        <div class="col-md-9 col-sm-12">

        
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_empleos',
                'summary' => '',
            ]); ?>
        </div>
    </div>

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <!-- <p>
        <?= Html::a('Create Empleos', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'descripcion',
            'created_at:datetime',
            [
                'attribute' => 'profesion.pronom',
                'format' => 'text',
                'label' => 'Profesión',
            ],
            'poblacion.nombre',
            'empleador.nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> -->


</>
