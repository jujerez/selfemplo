<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ValoracionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Valoraciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="valoraciones-index container">

    <section class="row">

        <div class="col-12">

        <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_valoraciones',
                'summary' => '',
                'layout' => "{summary}\n{items}\n{pager}\n",
                
            ]); ?>
        </div>
    
    </section>

</main>
