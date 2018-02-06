<?php

use yii\db\Migration;

class m170301_120816_item_featured extends Migration
{
    public function up()
    {
        $this->addColumn('{{%items}}', 'isFeatured', 'TINYINT(1) DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('{{%items}}', 'isFeatured');
    }
}
