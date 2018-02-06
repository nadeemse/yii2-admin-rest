<?php

use yii\db\Migration;

class m170622_010405_languages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%languages}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'flag' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%languages}}');
    }
}
