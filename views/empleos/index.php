<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpleosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empleos';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="empleos-index container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Empleos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
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
    ]); ?>


</>
