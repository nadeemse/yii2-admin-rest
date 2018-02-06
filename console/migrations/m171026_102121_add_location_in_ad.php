<?php

use yii\db\Migration;

class m171026_102121_add_location_in_ad extends Migration
{
    public function up()
    {
        $this->addColumn('{{%items}}', 'location', 'VARCHAR(255) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%items}}', 'location');

    }
}
