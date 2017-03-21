<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Travel */

$this->title = 'Create Travel';
$this->params['breadcrumbs'][] = ['label' => 'Travels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
