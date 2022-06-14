<?php

namespace app\models;

use yii\web\NotFoundHttpException;

class BaseModel extends \yii\base\Model
{
    /**
     * returns Model path using Controller class path
     *
     * @param $class
     * @return string
     * @throws NotFoundHttpException
     */
    public static function defineModel($class)
    {
        if (preg_match("/app\\\controllers\\\(\S+)Controller/", get_class($class), $matches)) {
            return 'app\\models\\' . $matches[1];
        }
        throw new NotFoundHttpException('The controller does not exist.');
    }

    /**
     * Returns array of all wishlists for select field
     *
     * @return array
     */
    public static function getAllWishlists(): array
    {
        $wishlists[''] = 'Without Wish list';
        foreach (Wishlist::find()->each() as $wishlist) {
            $wishlists[$wishlist->id] = $wishlist->title;
        }
        return $wishlists;
    }

    /**
     * Returns array of all categories for select field
     *
     * @return array
     */
    public static function getAllCategories(): array
    {
        $categories = [];
        foreach (Category::find()->each() as $category) {
            $categories[$category->id] = $category->name;
        }
        return $categories;
    }
}