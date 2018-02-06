<?php

use yii\db\Migration;

class m160926_193358_item_usages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item_usages}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%item_usages}}');
    }
}
