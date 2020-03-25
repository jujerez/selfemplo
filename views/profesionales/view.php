<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profesionales */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profesionales-view container">

    <div class="row justify-content-around">
        <div class="col-md-6 p-3">

            <div class="shadow p-3">

                <h1><?= Html::encode($this->title) ?></h1>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        
                        'nombre',
                        'apellidos',
                        'telefono',
                        'direccion',
                        'slogan',
                        'poblacion.nombre',
                        'poblacion.provincia.nombre',
                        'profesion.pronom',
                        'secto.secnom'
                        
                        
                    ],
                ]) ?>

                <p>
                    <?= Html::a('Modificar mis datos', ['update', 'id' => $model->usuario_id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar mi cuenta', ['delete', 'id' => $model->usuario_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estas seguro que deseas eliminar su cuenta? se eliminarán todos los datos relacionados con su cuenta',
                            'method' => 'post',
                        ],
                    ]) ?> 
                </p>
            </div>
        </div>
    </div>

</div>
