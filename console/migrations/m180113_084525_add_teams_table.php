<?php

use yii\db\Migration;

/**
 * Class m180113_084525_add_teams_table
 */
class m180113_084525_add_teams_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%team}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'designation' => $this->string()->notNull(),
            'sort_order' => $this->integer()->defaultValue(1),
            'pic' => $this->string(),
            'bio' => $this->string(),
            'facebook' => $this->string(),
            'linkedin' => $this->string(),
            'twitter' => $this->string(),
            'youtube' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%team}}');
    }
}
