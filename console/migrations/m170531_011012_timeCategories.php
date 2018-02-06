<?php

use yii\db\Migration;

class m170531_011012_timeCategories extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%time_categories}}', [
            'id' => $this->primaryKey(),
            'days' => $this->integer()->notNull(),
            'title' => $this->string(),
            'sort_order' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%time_categories}}');
    }
}
