<?php

use yii\db\Migration;

class m170127_113613_add_country_code extends Migration
{
    public function up()
    {
        $this->addColumn('{{%accounts}}', 'country_code', 'VARCHAR(255)');

    }

    public function down()
    {
        $this->dropColumn('{{%accounts}}', 'country_code');

    }
}
