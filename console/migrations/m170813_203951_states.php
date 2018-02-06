<?php

use yii\db\Migration;

class m170813_203951_states extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%states}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'icon' => $this->string(),
            'sort_order' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('country_state', '{{%states}}', 'country_id');
        $this->addForeignKey('country_state_fk', '{{%states}}', 'country_id', '{{%country}}', 'id', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('{{%states}}');
    }
}
