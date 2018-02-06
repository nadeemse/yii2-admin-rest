<?php

use yii\db\Migration;

class m170310_183124_item_filter_update extends Migration
{
    public function up()
    {
        $this->addColumn('{{%items}}', 'value', 'VARCHAR(255) DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%items}}', 'value');
    }

}
