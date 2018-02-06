<?php

use yii\db\Migration;

class m170317_170145_add_keywords_in_news extends Migration
{
    public function up()
    {
        $this->addColumn('{{%news}}', 'tag', 'VARCHAR(255) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%news}}', 'tag');
    }

}
