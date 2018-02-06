<?php

use yii\db\Migration;

class m170418_035015_entertainment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entertainment}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'short_description' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'banner' => $this->string(),
            'tag' => $this->string(),
            'banner_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('entertainment_by_index', '{{%entertainment}}', 'created_by');
        $this->addForeignKey('entertainment_by_fk', '{{%entertainment}}', 'created_by', 'accounts', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%entertainment}}');
    }
}
