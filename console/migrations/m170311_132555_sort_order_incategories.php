<?php

use yii\db\Migration;

class m170311_132555_sort_order_incategories extends Migration
{
    public function up()
    {
        $this->addColumn('{{%categories}}', 'sort_order', 'INT(11) DEFAULT 0');

    }

    public function down()
    {
        $this->dropColumn('{{%categories}}', 'sort_order');

    }
}
