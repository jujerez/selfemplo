<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpleadoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empleadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="empleadores-index container">

<div class="row">
    <section class="col-12">
        <div class="p-4 bg-light">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Create Empleadores', ['create'], ['class' => 'btn btn-success']) ?>
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
                    //'created_at',
                    //'poblacion_id',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </section>
</div>



</main>
