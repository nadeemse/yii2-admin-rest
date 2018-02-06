<?php

use yii\db\Migration;

class m170312_173916_category_background_colur extends Migration
{
    public function up()
    {
        $this->addColumn('{{%categories}}', 'colour', "VARCHAR(255) DEFAULT '#E5E4E2'");
    }

    public function down()
    {
        $this->dropColumn('{{%categories}}', 'colour');
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
