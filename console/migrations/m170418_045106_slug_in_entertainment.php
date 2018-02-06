<?php

use yii\db\Migration;

class m170418_045106_slug_in_entertainment extends Migration
{
    public function up()
    {
        $this->addColumn('{{%entertainment}}', 'slug', "VARCHAR(255)");
    }

    public function down()
    {
        $this->dropColumn('{{%entertainment}}', 'slug');
    }
}
