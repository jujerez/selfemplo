<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleadores */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['perfil', 'id' => $model->usuario_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empleadores-view container">

    <div class="row justify-content-center align-content-center">

        <div class="col-12 shadow p-3">

            <h1><?= Html::encode($this->title) ?></h1>
    
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    
                    'nombre',
                    'apellidos',
                    'telefono',
                    'direccion',
                    'poblacion.nombre',
                    'provincia'
                    
                ],
            ]) ?>
    
            <p>
                <?= Html::a('Modificar', ['update', 'id' => $model->usuario_id], ['class' => 'btn btn-primary']) ?>
                 <?= Html::a('Eliminar mi cuenta', ['delete', 'id' => $model->usuario_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estas seguro que deseas eliminar su cuenta?, se eliminarán todos los datos relacionados con su cuenta.',
                        'method' => 'post',
                    ],
                ]) ?> 
            </p>
        </div>

    </div>

</div>
