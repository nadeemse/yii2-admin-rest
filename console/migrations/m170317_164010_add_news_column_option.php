<?php

use yii\db\Migration;

class m170317_164010_add_news_column_option extends Migration
{
    public function up()
    {
        $this->addColumn('{{%news}}', 'column', "VARCHAR(255) DEFAULT 'col-sm-4'");
    }

    public function down()
    {
        $this->dropColumn('{{%news}}', 'column');
    }
}
