<?php

use yii\db\Migration;

class m170906_131542_add_city_state_country_in_items extends Migration
{
    public function up()
    {
        $this->addColumn('{{%items}}', 'country_id', 'INT(11) DEFAULT NULL');
        $this->addColumn('{{%items}}', 'state_id', 'INT(11) DEFAULT NULL');
        $this->addColumn('{{%items}}', 'city_id', 'INT(11) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%items}}', 'country_id');
        $this->dropColumn('{{%items}}', 'state_id');
        $this->dropColumn('{{%items}}', 'city_id');

    }

}
