<?php

use yii\db\Migration;

class m171026_104258_add_address_components extends Migration
{
    public function up()
    {
        $this->addColumn('{{%items}}', 'address_components', 'TEXT DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%items}}', 'address_components');

    }
}
