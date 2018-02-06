<?php

use yii\db\Migration;

class m170220_182258_blog extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blogs}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'short_description' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'banner' => $this->integer(),
            'banner_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('created_by_index', '{{%blogs}}', 'created_by');
        $this->addForeignKey('created_by_fk', '{{%blogs}}', 'created_by', 'accounts', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%blogs}}');
    }

}
