<?php

use yii\db\Migration;

class m170310_182150_update_item_table extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%items}}', 'age_id', 'INT(11) NOT NULL DEFAULT 0');
        $this->alterColumn('{{%items}}', 'usage_id', 'INT(11) NOT NULL DEFAULT 0');
        $this->alterColumn('{{%items}}', 'condition_id', 'INT(11) NOT NULL DEFAULT 0');
    }

    public function down()
    {
        $this->alterColumn('{{%items}}', 'age_id', 'INT(11) NOT NULL DEFAULT 0');
        $this->alterColumn('{{%items}}', 'usage_id', 'INT(11) NOT NULL DEFAULT 0');
        $this->alterColumn('{{%items}}', 'condition_id', 'INT(11) NOT NULL DEFAULT 0');
    }
}
