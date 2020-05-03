<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Votos */

$this->title = 'Puntuar';
$this->params['breadcrumbs'][] = ['label' => 'Votos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<section class="votos-create container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'profesional' => $profesional,
        'presupuesto' => $presupuesto,
        
    ]) ?>

</section>
