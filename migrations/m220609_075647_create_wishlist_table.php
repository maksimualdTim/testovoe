<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wishlist}}`.
 */
class m220609_075647_create_wishlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wishlist}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'user_id' => 'integer not null REFERENCES user(id)',
            'updated_by' => 'integer not null REFERENCES user(id)',
            'slug' =>  $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wishlist}}');
    }
}
