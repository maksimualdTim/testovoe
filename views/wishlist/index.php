<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Wishlist;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WishlistSearch */
/* @var $model app\models\Wishlist */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wishlists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wishlist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Wishlist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                    'label' => 'categories',
                    'value' => function($data){
                        $categories = '';
                        foreach ($data->categories as $category){
                            $categories .= $category->name . ',';
                        }
                        return rtrim($categories, ',');
                    }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Wishlist $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'slug' => $model->slug]);
                 }
            ],
        ],
    ]); ?>


</div>
