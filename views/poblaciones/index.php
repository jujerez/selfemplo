<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PoblacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Poblaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="poblaciones-index container">

    <div class="row">
        <section class="col-12 ">

            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Crear Población', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        
                        'nombre',
                    
                        [
                            'attribute' => 'provincia.nombre',
                            'format' => 'text',
                            'label' => 'Provincia',
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </section>
    </div>



</main>
