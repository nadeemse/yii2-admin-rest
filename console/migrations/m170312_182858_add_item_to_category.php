<?php

use yii\db\Migration;

class m170312_182858_add_item_to_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item_to_category}}', [
            'id'            => $this->primaryKey(),
            'item_id'       => $this->integer()->notNull(),
            'category_id'     => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('item_category', '{{%item_to_category}}', 'item_id');
        $this->createIndex('item_category_to', '{{%item_to_category}}', 'category_id');

        $this->addForeignKey('item_category_fk', '{{%item_to_category}}', 'item_id', 'items', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('item_category_to_fk', '{{%item_to_category}}', 'category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%item_to_category}}');
    }

}
