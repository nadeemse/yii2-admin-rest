<?php

use yii\db\Migration;

class m170314_185804_default_value_for_filter_value extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%item_filters}}', 'filter_value', 'INT(11) DEFAULT 0');
    }

    public function down()
    {
        $this->alterColumn('{{%item_filters}}', 'filter_value', 'INT(11) DEFAULT 0');
    }
}
