<?php

use yii\db\Migration;

class m161118_122042_filter_values extends Migration
{
    /**
     * Up function will add migration into database table
     * @return boolean true or false
     * */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%filter_values}}', [
            'id'                    => $this->primaryKey(),
            'filter_id'             => $this->integer()->notNull(),
            'title'                 => $this->string()->notNull(),
            'sort_order'            => $this->integer()->defaultValue(0),
            'status'                => $this->integer()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('filter_value', '{{%filter_values}}', 'filter_id');
        $this->addForeignKey('filter_value_FK', '{{%filter_values}}', 'filter_id', 'filters', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * Down function will add migration into database table
     * @return boolean true or false
     * */
    public function safeDown()
    {
        $this->dropTable('{{%filter_values}}');
    }
}
