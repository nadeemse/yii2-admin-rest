<?php

use yii\db\Migration;

class m170211_192656_add_setting extends Migration
{
    public function up()
    {
        $this->addColumn('{{%settings}}', 'website', 'VARCHAR(255)');
        $this->addColumn('{{%settings}}', 'fax', 'VARCHAR(255)');
    }

    public function down()
    {
        $this->dropColumn('{{%settings}}', 'website');
        $this->dropColumn('{{%settings}}', 'fax');
    }
}
