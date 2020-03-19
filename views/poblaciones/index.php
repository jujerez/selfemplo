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
        <section class="col-12 shadow p-3">

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
                    'provincia_id',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </section>
    </div>



</main>
