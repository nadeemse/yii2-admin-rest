<?php

use yii\db\Migration;

class m170704_140140_translation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%translation}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull(),
            'language_id' => $this->integer()->notNull(),
            'value' => $this->string()
        ], $tableOptions);

        $this->createIndex('translation_language', '{{%translation}}', 'language_id');
        $this->addForeignKey('translation_language_fk', '{{%translation}}', 'language_id', '{{%languages}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%translation}}');
    }
}
