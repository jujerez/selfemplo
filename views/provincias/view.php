<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Provincias */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Provincias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="provincias-view container">

    <div class="row">
        <section class="col-12  shadow p-3">

            

            <h1><?= Html::encode($this->title) ?></h1>
        
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    
                    'nombre',
                ],
            ]) ?>
            <p>
                <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Esta seguro que desea eliminar esta provincia?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            

        </section>
    </div>



</div>
