<?php

use yii\db\Migration;

class m170114_082651_report_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%report_item}}', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'message' => $this->string(),
            'repetitive_listing' => $this->string(),
            'mis_categorized' => $this->string(),
            'spam_type' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('report_by_index', '{{%report_item}}', 'account_id');
        $this->addForeignKey('report_by_FK', '{{%report_item}}', 'account_id', 'accounts', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('reported_item_index', '{{%report_item}}', 'item_id');
        $this->addForeignKey('reported_item_FK', '{{%report_item}}', 'item_id', 'items', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%report_item}}');
    }
}
