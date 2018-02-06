<?php

use yii\db\Migration;

class m170903_071137_available_countries_check extends Migration
{
    public function up()
    {
        $this->addColumn('{{%country}}', 'isAvailable', 'INT(11) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%country}}', 'isAvailable');

    }
}
