<?php

use yii\db\Migration;

class m170307_191900_add_home_blog extends Migration
{
    public function up()
    {
        $this->addColumn('{{%blogs}}', 'onHome', 'TINYINT(1) DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('{{%blogs}}', 'onHome');
    }
}
