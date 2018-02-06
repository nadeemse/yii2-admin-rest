<?php

use yii\db\Migration;

class m160926_193350_item_conditions extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item_conditions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%item_conditions}}');
    }
}
