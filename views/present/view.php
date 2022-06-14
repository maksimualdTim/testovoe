<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Present */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Presents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="present-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'title',
            'price',
            'link',
            [
                    'format' => 'html',
                    'label' => 'Image',
                    'value' => Html::img($model->getImage(), ['width' => 200])
            ],
            [
                    'label' => 'wishlist',
                    'value' => $model->wishlist->title ?? '',
            ],
            [
                    'label' => 'user',
                    'value' => $model->user->username,
            ],
        ],
    ]) ?>

</div>
