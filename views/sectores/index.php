<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sectores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sectores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sectores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'secnom',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
