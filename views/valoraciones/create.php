<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Valoraciones */

$this->title = 'Create Valoraciones';
$this->params['breadcrumbs'][] = ['label' => 'Valoraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="valoraciones-create container">

<h1 class="text-center"><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
    'profesional' => $profesional,
    'presupuesto' => $presupuesto,
    
]) ?>

</section>
