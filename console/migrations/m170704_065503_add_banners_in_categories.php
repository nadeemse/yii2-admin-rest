<?php

use yii\db\Migration;

class m170704_065503_add_banners_in_categories extends Migration
{
    public function up()
    {
        $this->addColumn('{{%categories}}', 'header', "VARCHAR(255) DEFAULT NULL");
        $this->addColumn('{{%categories}}', 'mobile_header', "VARCHAR(255) DEFAULT NULL");
    }

    public function down()
    {
        $this->dropColumn('{{%categories}}', 'header');
        $this->dropColumn('{{%categories}}', 'mobile_header');
    }
}
