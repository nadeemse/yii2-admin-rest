<?php

use yii\db\Migration;

class m170611_035629_status_tab_description extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%countries_wiki_tabs}}', 'description', "text");

    }

    public function down()
    {
        $this->alterColumn('{{%countries_wiki_tabs}}', 'description', "VARCHAR(255)");
    }
}
