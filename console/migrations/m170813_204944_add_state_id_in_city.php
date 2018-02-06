<?php

use yii\db\Migration;

class m170813_204944_add_state_id_in_city extends Migration
{
    public function up()
    {
        $this->addColumn('{{%cities}}', 'state_id', 'INT(11) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%cities}}', 'state_id');

    }
}
