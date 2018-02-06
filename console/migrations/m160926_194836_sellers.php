<?php

use yii\db\Migration;

class m160926_194836_sellers extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'location' => $this->string(),
            'account_id' => $this->integer()->notNull(),
            'contact' => $this->string(),
            'logo' => $this->string(),
        ], $tableOptions);

        $this->createIndex('account_index', '{{%company}}', 'account_id');
        $this->addForeignKey('account_company_FK', '{{%company}}', 'account_id', 'accounts', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%company}}');
    }
}
