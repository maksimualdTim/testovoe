<?php

namespace app\factories;

use app\components\PresentCardWidget;
use app\models\Wishlist;
use yii\db\Exception;

class WidgetFactory
{
    public static function createWidgetByName(string $name)
    {
        switch (mb_strtolower($name)) {
            case 'present':
                return new PresentCardWidget();
            case 'wishlist':
                return new Wishlist();
            default:
                throw new Exception('Can\'t create widget with name ' . $name);
        }
    }
}