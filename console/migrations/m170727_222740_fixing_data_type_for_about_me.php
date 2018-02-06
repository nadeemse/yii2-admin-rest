<?php

use yii\db\Migration;

class m170727_222740_fixing_data_type_for_about_me extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%accounts}}', 'about_me', "text");
    }

    public function down()
    {
        $this->alterColumn('{{%accounts}}', 'about_me', "VARCHAR(255) DEFAULT NULL");
    }
}
