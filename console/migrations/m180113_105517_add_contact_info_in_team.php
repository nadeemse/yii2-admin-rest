<?php

use yii\db\Migration;

/**
 * Class m180113_105517_add_contact_info_in_team
 */
class m180113_105517_add_contact_info_in_team extends Migration
{
    public function up()
    {
        $this->addColumn('{{%team}}', 'address', 'VARCHAR(255) DEFAULT NULL');
        $this->addColumn('{{%team}}', 'phone_number', 'VARCHAR(255) DEFAULT NULL');
        $this->addColumn('{{%team}}', 'email', 'VARCHAR(255) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%team}}', 'address');
        $this->dropColumn('{{%team}}', 'phone_number');
        $this->dropColumn('{{%team}}', 'email');

    }
}
