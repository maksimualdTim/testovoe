<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presents}}`.
 */
class m220609_075726_create_presents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%presents}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'price' => $this->integer(),
            'link' => $this->string(),
            'image' => $this->string(),
            'wishlist_id' => 'integer REFERENCES wishlist(id)',
            'user_id' => 'integer not null REFERENCES user(id)',
            'updated_by' => 'integer not null REFERENCES user(id)',
            'slug' =>  $this->string(255)->notNull()->unique()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%presents}}');
    }
}
