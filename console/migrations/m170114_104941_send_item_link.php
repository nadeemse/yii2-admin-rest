<?php

use yii\db\Migration;

class m170114_104941_send_item_link extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item_sharing}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'message' => $this->string(),
            'name' => $this->string(),
            'email' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('shared_item_index', '{{%report_item}}', 'item_id');
        $this->addForeignKey('shared_item_FK', '{{%report_item}}', 'item_id', 'items', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%item_sharing}}');
    }
}
