<?php

use yii\db\Migration;

class m170127_163932_phone_verification extends Migration
{
    public function up()
    {
        $this->addColumn('{{%accounts}}', 'phone_verification', 'VARCHAR(15)');
    }

    public function down()
    {
        $this->dropColumn('{{%accounts}}', 'phone_verification');
    }
}
