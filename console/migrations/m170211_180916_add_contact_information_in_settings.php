<?php

use yii\db\Migration;

class m170211_180916_add_contact_information_in_settings extends Migration
{
    public function up()
    {
        $this->addColumn('{{%settings}}', 'contact_info', 'VARCHAR(255)');
    }

    public function down()
    {
        $this->dropColumn('{{%settings}}', 'contact_info');
    }
}
