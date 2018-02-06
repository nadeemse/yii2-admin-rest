<?php

use yii\db\Migration;

class m170312_190257_add_icons_in_filter extends Migration
{
    public function up()
    {
        $this->addColumn('{{%filters}}', 'icon', 'VARCHAR(255) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%filters}}', 'icon');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
