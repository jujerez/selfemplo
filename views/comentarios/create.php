<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */

$this->title = 'Create Comentarios';
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="comentarios-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'profesional' => $profesional,
        'presupuesto' => $presupuesto,
    ]) ?>

</div>
