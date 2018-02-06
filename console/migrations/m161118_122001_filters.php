<?php

use yii\db\Migration;

class m161118_122001_filters extends Migration
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

        $this->createTable('{{%filters}}', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string()->notNull(),
            'placeholder'           => $this->string()->notNull(),
            'form_name'             => $this->string()->notNull(),
            'type'                  => "ENUM('select', 'radio', 'checkbox', 'input', 'textarea', 'range', 'date', 'datetime') DEFAULT 'input'",
            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),
            'sort_order'            => $this->integer()->defaultValue(0),
            'status'                => $this->integer()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('filter_name', '{{%filters}}', 'name');
    }

    /**
     * Down function will add migration into database table
     * @return boolean true or false
     * */
    public function safeDown()
    {
        $this->dropTable('{{%filters}}');
    }
}
