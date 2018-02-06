<?php

use yii\db\Migration;

class m170317_164606_update_type extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%news}}', 'banner', 'VARCHAR(255)');
    }

    public function down()
    {
        $this->alterColumn('{{%news}}', 'banner', 'INT(11)');
    }
}
