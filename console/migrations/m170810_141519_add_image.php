<?php

use yii\db\Migration;

class m170810_141519_add_image extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%entertainment}}', 'type', "ENUM('serial', 'video', 'gallery') DEFAULT 'video'");
    }

    public function down()
    {
        $this->alterColumn('{{%entertainment}}', 'type', "ENUM('serial', 'video') DEFAULT 'video'");
    }
}
