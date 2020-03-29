<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdministradoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administradores';
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['perfil', 'id' => Yii::$app->user->identity->id] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="administradores-index container">
    <div class="row">
        <section class="col-12">

            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Create Administradores', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'nombre',
                        'apellidos',
                        'telefono',
                        'direccion',
                        'created_at:datetime',
                        //'poblacion.nombre',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>

        </section>
    </div>


</main>
