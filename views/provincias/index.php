<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvinciasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provincias';
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['administradores/perfil', 'id' => Yii::$app->user->identity->id] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="provincias-index container">

    <div class="row">
        <section class="col-12 ">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Crear Provincias', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [

                        'nombre',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </section>
    </div>



</main>
