<?php

use yii\db\Migration;

class m170611_014402_tabs extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tabs}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'banner' => $this->string(),
            'sort_order' => $this->integer(),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%tabs}}');
    }
}
