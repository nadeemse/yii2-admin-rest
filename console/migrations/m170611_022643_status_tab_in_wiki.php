<?php

use yii\db\Migration;

class m170611_022643_status_tab_in_wiki extends Migration
{
    public function up()
    {
        $this->addColumn('{{%countries_wiki_tabs}}', 'status', "TINYINT(1) DEFAULT 0");
        $this->addColumn('{{%countries_wiki_tabs}}', 'tab_id', "INT(11) NOT NULL");

        $this->createIndex('tabs_wiki', '{{%countries_wiki_tabs}}', 'tab_id');
        $this->addForeignKey('tabs_wiki_fk', '{{%countries_wiki_tabs}}', 'tab_id', '{{%tabs}}', 'id', 'CASCADE', 'CASCADE');



    }

    public function down()
    {
        $this->dropColumn('{{%countries_wiki_tabs}}', 'status');
        $this->dropColumn('{{%countries_wiki_tabs}}', 'tab_id');
    }
}
