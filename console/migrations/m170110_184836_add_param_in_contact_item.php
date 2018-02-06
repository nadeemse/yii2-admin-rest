<?php

use yii\db\Migration;

class m170110_184836_add_param_in_contact_item extends Migration
{
    public function up()
    {
        $this->addColumn('{{%item_contact}}', 'created_at', 'INT(11)');
        $this->addColumn('{{%item_contact}}', 'updated_at', 'INT(11)');

        $this->addColumn('{{%item_contact}}', 'name', 'VARCHAR(255) NOT NULL');
        $this->addColumn('{{%item_contact}}', 'email', 'VARCHAR(255) NOT NULL');


    }

    public function down()
    {
        $this->dropColumn('{{%item_contact}}', 'created_at');
        $this->dropColumn('{{%item_contact}}', 'updated_at');
        $this->dropColumn('{{%item_contact}}', 'name');
        $this->dropColumn('{{%item_contact}}', 'email');
    }
}
