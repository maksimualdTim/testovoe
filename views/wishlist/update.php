<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Wishlist */
/* @var array $categories */
/* @var array $selected */

$this->title = 'Update Wishlist: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Wishlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wishlist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'selected' => $selected,
    ]) ?>

</div>
