<?php

use yii\db\Migration;

class m170428_174815_video_in_entertainment extends Migration
{
    public function up()
    {
        $this->addColumn('{{%entertainment}}', 'video_url', "VARCHAR(255)");
    }

    public function down()
    {
        $this->dropColumn('{{%entertainment}}', 'video_url');
    }
}
