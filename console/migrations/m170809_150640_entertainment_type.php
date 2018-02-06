<?php

use yii\db\Migration;

class m170809_150640_entertainment_type extends Migration
{
    public function up()
    {
        $this->addColumn('{{%entertainment}}', 'type', "ENUM('serial', 'video') DEFAULT 'video'");
    }

    public function down()
    {
        $this->dropColumn('{{%entertainment}}', 'type');
    }
}
