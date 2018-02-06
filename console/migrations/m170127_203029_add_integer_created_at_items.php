<?php

use yii\db\Migration;

class m170127_203029_add_integer_created_at_items extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%items}}', 'created_at', 'INT(11)');
        $this->alterColumn('{{%items}}', 'updated_at', 'INT(11)');
    }

    public function down()
    {
        $this->alterColumn('{{%items}}', 'created_at', 'DATETIME');
        $this->addColumn('{{%items}}', 'updated_at', 'DATETIME');
    }
}
