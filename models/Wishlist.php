<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "wishlist".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $user_id
 *
 * @property Present[] $presents
 * @property User $user
 * @property Category[] $wishlistCategories
 */
class Wishlist extends \yii\db\ActiveRecord
{
    public $categoriesArray;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['user_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['categoriesArray'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'immutable' => true,
                'ensureUnique' => true,
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (isset($this->categoriesArray) && !empty($this->categoriesArray)) {
            if(!$insert){
                WishlistCategory::deleteAll(['wishlist_id' => $this->id]);
            }

            foreach ($this->categoriesArray as $categoryId) {
                $model = new WishlistCategory();
                $model->category_id = $categoryId;
                $model->wishlist_id = $this->id;
                $model->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Present]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresents()
    {
        return $this->hasMany(Present::class, ['wishlist_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('wishlist_category', ['wishlist_id' => 'id']);
    }

    public function getSelectedCategories(){
        $categories = $this->categories;
        $selected = [];
        foreach ($categories as $category){
            $selected[$category->id]['Selected'] = true;
        }
        return $selected;
    }
}
