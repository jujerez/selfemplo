<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Administradores */

$this->title = 'Modificar perfil: ' . $model->usuario_id;
$this->params['breadcrumbs'][] = ['label' => 'Administradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<main class="administradores-update container">
    <div class="row">
        <section class="col-12">
            <div class="p-4 bg-light">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </section>
    </div>

</main>
