<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfesionalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profesionales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profesionales-index container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profesionales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usuario_id',
            'nombre',
            'apellidos',
            'telefono',
            'direccion',
            //'slogan',
            //'created_at',
            //'poblacion_id',
            //'profesion_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
