<?php

use yii\db\Migration;

class m170110_023214_contact_types extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contact_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%contact_types}}');
    }
}
