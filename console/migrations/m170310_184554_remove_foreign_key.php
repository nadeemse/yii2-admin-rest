<?php

use yii\db\Migration;

class m170310_184554_remove_foreign_key extends Migration
{
    public function up()
    {
        $this->dropForeignKey('filter_filter_value_fk', '{{%item_filters}}');
    }

    public function down()
    {
        $this->addForeignKey('filter_filter_value_fk', '{{%item_filters}}', 'filter_value', 'filter_values', 'id', 'CASCADE', 'CASCADE');

    }

}
