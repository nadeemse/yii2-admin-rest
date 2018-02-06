<?php

use yii\db\Migration;

class m170612_011822_display_type_in_tabs extends Migration
{
    public function up()
    {
        $this->addColumn('{{%wiki_tab_faq}}', 'display_type', "ENUM('box', 'accordion') DEFAULT 'accordion'");

    }

    public function down()
    {
        $this->dropColumn('{{%wiki_tab_faq}}', 'display_type');
    }
}
