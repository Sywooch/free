<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TravelHasUser */

$this->title = 'Update Travel Has User: ' . $model->travel_id;
$this->params['breadcrumbs'][] = ['label' => 'Travel Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->travel_id, 'url' => ['view', 'travel_id' => $model->travel_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="travel-has-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
