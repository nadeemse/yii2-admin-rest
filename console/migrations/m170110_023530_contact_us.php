<?php

use yii\db\Migration;

class m170110_023530_contact_us extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%contact_us}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'phone_number' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'message' => $this->string(),
        ], $tableOptions);

        $this->createIndex('contact_type', '{{%contact_us}}', 'type_id');
        $this->addForeignKey('contact_type_FK', '{{%contact_us}}', 'type_id', 'contact_types', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%contact_us}}');
    }
}
