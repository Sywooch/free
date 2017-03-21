<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrationForm */
/* @var $form ActiveForm */
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registration-index">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'email') ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
<p>Извините, но пользователь с таким логином уже зарегистрирован ранее!</p>
</div><!-- registration-index -->
