<?php

use yii\db\Migration;

class m170108_075515_add_company_email extends Migration
{
    public function up()
    {
        $this->addColumn('{{%company}}', 'email', 'VARCHAR(255) DEFAULT NULL');

        $this->addColumn('{{%company}}', 'created_at', 'INT(11)');
        $this->addColumn('{{%company}}', 'updated_at', 'INT(11)');

    }

    public function down()
    {
        $this->dropColumn('{{%company}}', 'email');
        $this->dropColumn('{{%company}}', 'created_at');
        $this->dropColumn('{{%company}}', 'updated_at');
    }
}