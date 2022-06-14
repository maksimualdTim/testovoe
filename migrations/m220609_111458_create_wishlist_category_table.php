<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wishlist_category}}`.
 */
class m220609_111458_create_wishlist_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wishlist_category}}', [
            'wishlist_id' => 'integer REFERENCES wishlist(id)',
            'category_id' => 'integer REFERENCES categories(id)',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wishlist_category}}');
    }
}
