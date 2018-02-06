<?php

use yii\db\Migration;

class m170317_164918_add_slug_for_news extends Migration
{
    public function up()
    {
        $this->addColumn('{{%news}}', 'slug', "VARCHAR(255)");
    }

    public function down()
    {
        $this->dropColumn('{{%news}}', 'slug');
    }

}
