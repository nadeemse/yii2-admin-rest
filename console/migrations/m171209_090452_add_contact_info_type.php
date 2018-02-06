<?php

use yii\db\Migration;

class m171209_090452_add_contact_info_type extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%settings}}', 'contact_info', 'TEXT DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('{{%settings}}', 'contact_info', 'VARCHAR(255) DEFAULT NULL');

    }
}
