<?php

use yii\db\Migration;

class m170313_200552_add_control_in_filters extends Migration
{
    public function up()
    {
        $this->addColumn('{{%filters}}', 'isOnListing', 'TINYINT(1) DEFAULT 0');
        $this->addColumn('{{%filters}}', 'isOnDetail', 'TINYINT(1) DEFAULT 1');
        $this->addColumn('{{%filters}}', 'isOnSearch', 'TINYINT(1) DEFAULT 1');

    }

    public function down()
    {
        $this->dropColumn('{{%filters}}', 'isOnListing');
        $this->dropColumn('{{%filters}}', 'isOnDetail');
        $this->dropColumn('{{%filters}}', 'isOnSearch');
    }
}
