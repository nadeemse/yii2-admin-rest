<?php

use yii\db\Migration;

class m170310_133001_item_filters extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item_filters}}', [
            'id'            => $this->primaryKey(),
            'item_id'       => $this->integer()->notNull(),
            'filter_id'     => $this->integer()->notNull(),
            'filter_value'  => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('filter_item', '{{%item_filters}}', 'item_id');
        $this->createIndex('filter_filter', '{{%item_filters}}', 'filter_id');
        $this->createIndex('filter_filter_value', '{{%item_filters}}', 'filter_value');

        $this->addForeignKey('filter_item_fk', '{{%item_filters}}', 'item_id', 'items', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('filter_filter_fk', '{{%item_filters}}', 'filter_id', 'filters', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('filter_filter_value_fk', '{{%item_filters}}', 'filter_value', 'filter_values', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%item_filters}}');
    }
}
