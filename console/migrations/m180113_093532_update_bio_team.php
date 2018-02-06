<?php

use yii\db\Migration;

/**
 * Class m180113_093532_update_bio_team
 */
class m180113_093532_update_bio_team extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%team}}', 'bio', 'TEXT DEFAULT NULL');
        $this->addColumn('{{%team}}', 'short_bio', 'VARCHAR(255) DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('{{%team}}', 'bio', 'VARCHAR(255) DEFAULT NULL');
        $this->dropColumn('{{%team}}', 'short_bio');

    }
}
