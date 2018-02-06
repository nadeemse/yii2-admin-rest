<?php

use yii\db\Migration;

/**
 * Class m180117_211343_add_description
 */
class m180117_211343_add_description extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%partners}}', 'description', 'TEXT DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('{{%partners}}', 'description', 'VARCHAR(255) DEFAULT NULL');

    }
}
