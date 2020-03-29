<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profesiones */

$this->title = $model->pronom;
$this->params['breadcrumbs'][] = ['label' => 'Profesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="profesiones-view container">

    <div class="row">
        <section class="col-12">

            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>
    
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        
                        'pronom',
                        'sector.secnom',
                    ],
                ]) ?>
                <p>
                    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'borrar.confirm' => '¿Esta seguro de eliminar este elemento?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>


        </section>
    </div>


</main>
