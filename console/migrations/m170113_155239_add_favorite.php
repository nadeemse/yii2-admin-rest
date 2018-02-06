<?php

use yii\db\Migration;

class m170113_155239_add_favorite extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%favorite}}', [
            'id'                    => $this->primaryKey(),
            'account_id'            => $this->integer()->notNull(),
            'item_id'               => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('account_favorite_index', '{{%favorite}}', 'account_id');
        $this->addForeignKey('account_favorite_FK', '{{%favorite}}', 'account_id', 'accounts', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('item_favorite_index', '{{%favorite}}', 'item_id');
        $this->addForeignKey('item_favorite_FK', '{{%favorite}}', 'item_id', 'items', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%favorite}}');
    }

}
