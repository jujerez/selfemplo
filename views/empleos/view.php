<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleos */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Empleos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="empleos-view container">

    <div class="row">

        <section class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>
    
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                               
                        'titulo',
                        'descripcion',
                        'created_at:datetime',
                        'poblacion.nombre',
                        'empleador.nombre',
                        'profesion.pronom',
                    ],
                    ]) ?>
                <p>
                    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estas seguro que deseas eliminar este empleo?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>

        </section>
    </div>


</main>
