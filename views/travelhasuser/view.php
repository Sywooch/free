<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TravelHasUser */

$this->title = $model->travel_id;
$this->params['breadcrumbs'][] = ['label' => 'Travel Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travel-has-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'travel_id' => $model->travel_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'travel_id' => $model->travel_id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'travel_id',
            'user_id',
        ],
    ]) ?>

</div>
