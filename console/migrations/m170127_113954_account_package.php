<?php

use yii\db\Migration;

class m170127_113954_account_package extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%account_packages}}', [
            'id' => $this->primaryKey(),
            'package_id' => $this->integer()->notNull(),
            'account_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'expire_on' => $this->date(),
            'payment_reference' => $this->string(),
            'payment_gateway' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('package_account_index', '{{%account_packages}}', 'package_id');
        $this->addForeignKey('package_account_FK', '{{%account_packages}}', 'package_id', 'packages', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('account_account_index', '{{%account_packages}}', 'account_id');
        $this->addForeignKey('account_account_FK', '{{%account_packages}}', 'account_id', 'accounts', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%account_packages}}');
    }
}
