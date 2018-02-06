<?php

use yii\db\Migration;

class m170113_162546_add_count_in_item extends Migration
{
    public function up()
    {
        $this->addColumn('{{%items}}', 'visitCount', 'INT(11) DEFAULT 0');
        $this->addColumn('{{%items}}', 'favoriteCount', 'INT(11) DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('{{%items}}', 'visitCount');
        $this->dropColumn('{{%items}}', 'favoriteCount');
    }
}
