<?php

namespace app\models;

use app\components\UploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "presents".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int|null $price
 * @property string|null $link
 * @property string|null $image
 * @property int|null $wishlist_id
 * @property int $user_id
 *
 * @property User $user
 * @property Wishlist $wishlist
 */
class Present extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['price', 'wishlist_id', 'user_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 100],
            [['link'], 'string', 'max' => 255],
            [['link'], 'url', 'message' => 'Link must be a valid url'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['wishlist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wishlist::class, 'targetAttribute' => ['wishlist_id' => 'id']],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            [
                'class' => UploadImageBehavior::class,
            ]
        ];
    }

    public function beforeDelete()
    {
        $this->deleteCurrentImage($this->image);
        return parent::beforeDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Price',
            'link' => 'Link',
            'image' => 'Image',
            'wishlist_id' => 'Wishlist ID',
            'user_id' => 'User ID',
        ];
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
     * Gets query for [[Wishlist]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWishlist()
    {
        return $this->hasOne(Wishlist::class, ['id' => 'wishlist_id']);
    }

    public function getImage()
    {
        return ($this->image) ? '/uploads/' . $this->image : '/uploads/no-image.png';
    }

    public function setUploadedImage()
    {
        $file = UploadedFile::getInstance($this, 'image');
        $filename = '';
        if (!empty($file)) {
            $filename = $this->uploadFile($file);
        }
        $this->image = $filename;
    }
}
