<?php

use yii\db\Migration;

class m170113_153201_add_social_links_in_setting extends Migration
{
    public function up()
    {
        $this->addColumn('{{%settings}}', 'facebook','VARCHAR(255)');
        $this->addColumn('{{%settings}}', 'twitter', 'VARCHAR(255)');

        $this->addColumn('{{%settings}}', 'instagram', 'VARCHAR(255)');
        $this->addColumn('{{%settings}}', 'youtube', 'VARCHAR(255)');


    }

    public function down()
    {
        $this->dropColumn('{{%settings}}', 'facebook');
        $this->dropColumn('{{%settings}}', 'twitter');
        $this->dropColumn('{{%settings}}', 'instagram');
        $this->dropColumn('{{%settings}}', 'youtube');
    }

}
