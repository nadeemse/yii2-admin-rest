<?php

use yii\db\Migration;

class m170811_123937_add_settings_in_category_filters extends Migration
{
    public function up()
    {
        $this->addColumn('{{%category_filter}}', 'type', "ENUM('primary', 'advance', 'notIncluded') DEFAULT 'notIncluded'");
        $this->addColumn('{{%category_filter}}', 'class', "ENUM('col-sm-12', 'col-sm-6') DEFAULT 'col-sm-6'");
    }

    public function down()
    {
        $this->dropColumn('{{%category_filter}}', 'type');
        $this->dropColumn('{{%category_filter}}', 'class');
    }
}
