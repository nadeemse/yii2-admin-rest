<?php

use yii\db\Migration;

class m170310_185009_value_toField_value_item_filter extends Migration
{
    public function up()
    {
        $this->addColumn('{{%item_filters}}', 'field_value', 'VARCHAR(255) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropForeignKey('{{%item_filters}}', 'field_value');
    }
}
