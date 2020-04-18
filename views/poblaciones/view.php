<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Poblaciones */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Poblaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="poblaciones-view container">

    <div class="row">
        <section class="col-12 ">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Esta seguro que desea eliminar esta población?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                    
                        'nombre',
                        [
                            'attribute' => 'provincia.nombre',
                            'format' => 'text',
                            'label' => 'Provincia',
                        ],

                    ],
                ]) ?>
            </div>
            
        </section>
    </div>


</div>
