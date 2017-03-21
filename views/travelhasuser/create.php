<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TravelHasUser */

$this->title = 'Create Travel Has User';
$this->params['breadcrumbs'][] = ['label' => 'Travel Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travel-has-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
