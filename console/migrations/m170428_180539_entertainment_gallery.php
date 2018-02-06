<?php

use yii\db\Migration;

class m170428_180539_entertainment_gallery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entertainment_gallery}}', [
            'id' => $this->primaryKey(),
            'entertainment_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'image' => $this->string()->notNull(),
            'link' => $this->string(),
            'sort_order' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex( 'entertainment_gallery', '{{%entertainment_gallery}}', 'entertainment_id');
        $this->addForeignKey( 'entertainment_gallery_fk', '{{%entertainment_gallery}}', 'entertainment_id', '{{%entertainment}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('{{%entertainment_gallery}}');
    }
}
