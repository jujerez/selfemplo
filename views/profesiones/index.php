<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfesionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profesiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="profesiones-index container">

    <div class="row">
        <section class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <p>
                    <?= Html::a('Crear Profesiones', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
            
                        'pronom',
                        'sector.secnom',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>  

        </section>
    </div>

   

</main>
