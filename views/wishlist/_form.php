<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Wishlist */
/* @var array $categories */
/* @var array $selected */
/* @var $form yii\widgets\ActiveForm */

$selected = $selected ?? [];
?>

<div class="wishlist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoriesArray')->dropDownList($categories, ['multiple' => true, 'options' => $selected])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
