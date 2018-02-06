<?php

use yii\db\Migration;

class m170125_193724_package_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%packages}}', 'title', 'VARCHAR(255)');
        $this->addColumn('{{%packages}}', 'price_title', 'VARCHAR(255)');
        $this->addColumn('{{%packages}}', 'title_description', 'VARCHAR(255)');
    }

    public function down()
    {
        $this->dropColumn('{{%packages}}', 'title');
        $this->dropColumn('{{%packages}}', 'price_title');
        $this->dropColumn('{{%packages}}', 'title_description');
    }

}
