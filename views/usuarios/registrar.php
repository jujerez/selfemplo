<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Registrar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-registrar">
    <h1><?= Html::encode($this->title) ?></h1>



    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => ['wrapper' => 'col-sm-5'],
        ],
    ]); ?>

        <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'rol')->dropDownList($roles) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        <?= $form->field($model, 'email')->passwordInput(['type' => 'email']) ?>




        <div class="form-group">
            <div class="offset-sm-2">
                <?= Html::submitButton('Crear', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


</div>