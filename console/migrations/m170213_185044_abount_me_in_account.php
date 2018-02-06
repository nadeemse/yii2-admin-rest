<?php

use yii\db\Migration;

class m170213_185044_abount_me_in_account extends Migration
{
    public function up()
    {
        $this->addColumn('{{%accounts}}', 'about_me', 'VARCHAR(255)');
    }

    public function down()
    {
        $this->dropColumn('{{%accounts}}', 'about_me');
    }
}
