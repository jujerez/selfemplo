<?php

use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sectores */

$this->title = $model->secnom;
$this->params['breadcrumbs'][] = ['label' => 'Sectores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main class="container sectores-view">
    <div class="row">
        <section class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>
                  
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [                     
                        'secnom',
                    ],
                ]) ?>
                <p>
                    <?= Html::a(Icon::show('pencil-alt'). '' .' Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Icon::show('trash-alt'). '' .' Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </section>
    </div>


</main>
