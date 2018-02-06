<?php

use yii\db\Migration;

class m170125_193923_package_features extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%package_features}}', [
            'id' => $this->primaryKey(),
            'package_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'sort_order' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('package_features_index', '{{%package_features}}', 'package_id');
        $this->addForeignKey('package_features_FK', '{{%package_features}}', 'package_id', 'packages', 'id', 'CASCADE', 'CASCADE');


    }

    public function down()
    {
        $this->dropTable('{{%package_features}}');
    }
}
