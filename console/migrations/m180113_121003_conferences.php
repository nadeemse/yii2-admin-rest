<?php

use yii\db\Migration;

/**
 * Class m180113_121003_conferences
 */
class m180113_121003_conferences extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%conferences}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'short_description' => $this->string()->notNull(),
            'sort_order' => $this->integer()->defaultValue(1),
            'icon' => $this->string(),
            'description' => $this->string(),
            'dp_style' => $this->string(),
            'banner_id' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('banner_index', '{{%conferences}}', 'banner_id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%conferences}}');
    }
}
