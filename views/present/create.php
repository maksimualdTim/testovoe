<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Present */
/* @var array $wishlists */

$this->title = 'Create Present';
$this->params['breadcrumbs'][] = ['label' => 'Presents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="present-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'wishlists' => $wishlists
    ]) ?>

</div>
