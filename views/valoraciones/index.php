<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ValoracionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Valoraciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valoraciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Valoraciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'voto',
            'comentario',
            'created_at',
            'empleador_id',
            //'profesional_id',
            //'presupuesto_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
