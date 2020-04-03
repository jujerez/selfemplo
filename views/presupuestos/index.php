<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresupuestosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presupuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presupuestos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Presupuestos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'precio',
            'duracion_estimada',
            'estado:boolean',
            'profesional_id',
            //'empleo_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
