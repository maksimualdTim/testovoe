<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wishlist_category".
 *
 * @property int|null $wishlist_id
 * @property int|null $category_id
 *
 * @property Category $category
 * @property Wishlist $wishlist
 */
class WishlistCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishlist_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wishlist_id', 'category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['wishlist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wishlist::className(), 'targetAttribute' => ['wishlist_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wishlist_id' => 'Wishlist ID',
            'category_id' => 'Category ID',
        ];
    }
}
