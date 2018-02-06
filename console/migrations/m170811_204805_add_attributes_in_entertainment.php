<?php

use yii\db\Migration;

class m170811_204805_add_attributes_in_entertainment extends Migration
{
    public function up()
    {
        $this->addColumn('{{%entertainment}}', 'genres_id', "INT(11) DEFAULT NULL");
        $this->addColumn('{{%entertainment}}', 'viewCount', "INT(11) DEFAULT 0");
        $this->addColumn('{{%entertainment}}', 'release_date', "DATE DEFAULT NULL");
        $this->addColumn('{{%entertainment}}', 'country_id', "INT(11) DEFAULT NULL");
    }

    public function down()
    {
        $this->dropColumn('{{%entertainment}}', 'genres_id');
        $this->dropColumn('{{%entertainment}}', 'viewCount');
        $this->dropColumn('{{%entertainment}}', 'release_date');
        $this->dropColumn('{{%entertainment}}', 'country_id');
    }

}
