<?php

use yii\db\Migration;

class m170811_205554_genres_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%genres}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'sort_order' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%genres}}');
    }
}
