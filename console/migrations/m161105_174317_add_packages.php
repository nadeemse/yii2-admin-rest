<?php

use yii\db\Migration;

class m161105_174317_add_packages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%packages}}', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string()->notNull(),
            'duration'          => $this->integer()->notNull(),
            'duration_type'     => "ENUM('Days','Months','Years', 'UnLimted') NOT NULL DEFAULT 'Days'",
            'price'             => $this->double()->notNull()->defaultValue(0),
            'feature_ads_count' => $this->integer()->defaultValue(0),
            'free_ads_posting'  => $this->smallInteger()->defaultValue(1),
            'status'            => $this->smallInteger(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%packages}}');
    }
}
