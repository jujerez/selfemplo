<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VotosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Votos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="votos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Votos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'voto',
            'created_at',
            'empleador_id',
            'profesional_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
