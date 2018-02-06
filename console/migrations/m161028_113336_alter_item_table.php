<?php

use yii\db\Migration;

class m161028_113336_alter_item_table extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%items}}', 'price', 'FLOAT(10, 2) NOT NULL');

    }

    public function down()
    {
        $this->alterColumn('{{%items}}', 'area_code', 'FLOAT(10, 2) NOT NULL');
    }
}
