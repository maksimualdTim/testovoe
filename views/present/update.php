<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Present */
/* @var array $wishlists */
$this->title = 'Update Present: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Presents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="present-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'wishlists' => $wishlists
    ]) ?>

</div>
