<?php

use yii\db\Migration;

class m170810_164759_banner_image extends Migration
{
    public function up()
    {
        $this->addColumn('{{%entertainment}}', 'banner_image', "VARCHAR(255) DEFAULT NULL");
    }

    public function down()
    {
        $this->dropColumn('{{%entertainment}}', 'banner_image');
    }
}
