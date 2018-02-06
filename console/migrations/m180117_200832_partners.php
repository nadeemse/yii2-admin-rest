<?php

use yii\db\Migration;

/**
 * Class m180117_200832_partners
 */
class m180117_200832_partners extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%partners}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'short_description' => $this->string()->notNull(),
            'sort_order' => $this->integer()->defaultValue(1),
            'icon' => $this->string(),
            'description' => $this->string(),
            'dp_style' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%partners}}');
    }
}
