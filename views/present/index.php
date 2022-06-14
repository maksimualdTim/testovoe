<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Present;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresentSearch */
/* @var $model app\models\Present */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="present-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Present', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'price',
            [
                    'format' => 'html',
                    'label' => 'Link',
                    'value' => function ($data){
                        return Html::a($data->link, $data->link);
                    }
            ],
            [
                    'format' => 'html',
                    'label' => 'image',
                    'value' => function ($data){
                        return Html::img($data->getImage(), ['width' => 200]);
                    }
            ],
            [
                    'format' => 'text',
                    'label' => 'wishlist',
                    'value' => function ($data){
                        return $data->wishlist->title ?? '';
                    }
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Present $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'slug' => $model->slug]);
                 }
            ],
        ],
    ]); ?>


</div>
