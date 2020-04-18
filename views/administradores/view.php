<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Administradores */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Administradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="administradores-view container">

    <div class="row">
        <section class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'usuario_id',
                            'nombre',
                            'apellidos',
                            'telefono',
                            'direccion',
                            'created_at',
                            'poblacion_id',
                        ],
                    ]) ?>
                <p>
                    <?= Html::a('Modificar mis datos', ['update', 'id' => $model->usuario_id], ['class' => 'btn btn-primary']) ?>
                    <!-- <?= Html::a('Eliminar mi cuenta', ['delete', 'id' => $model->usuario_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estas seguro que deseas eliminar su cuenta?, se eliminarán todos los datos relacionados con su cuenta',
                            'method' => 'post',
                        ],
                    ]) ?> -->
                </p>

            </div>
        </section>
    </div>


</main>
