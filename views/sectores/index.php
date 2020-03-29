<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sectores';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="sectores-index container">

    <div class="row">
        <section class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'secnom',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <p>
                    <?= Html::a('Crear sector', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
        </section>
    </div>

   


</main>
