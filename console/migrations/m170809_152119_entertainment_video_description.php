<?php

use yii\db\Migration;

class m170809_152119_entertainment_video_description extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%entertainment_videos}}', 'description', "text");
    }

    public function down()
    {
        $this->alterColumn('{{%entertainment_videos}}', 'description', 'varchar(255) DEFAULT NULL');
    }
}
