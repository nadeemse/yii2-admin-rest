<?php

use yii\db\Migration;

class m160926_193419_item_contact extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item_contact}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'phone_number' => $this->string()->notNull(),
            'message' => $this->string()->notNull()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%item_contact}}');
    }
}
