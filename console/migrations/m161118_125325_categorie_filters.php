<?php

use yii\db\Migration;

class m161118_125325_categorie_filters extends Migration
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

        $this->createTable('{{%category_filter}}', [
            'id'                    => $this->primaryKey(),
            'filter_id'             => $this->integer()->notNull(),
            'category_id'           => $this->integer()->notNull(),
            'is_required'           => $this->smallInteger()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('filter_to_category', '{{%category_filter}}', 'filter_id');
        $this->addForeignKey('filter_to_category_FK', '{{%category_filter}}', 'filter_id', 'filters', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('category_filter', '{{%category_filter}}', 'category_id');
        $this->addForeignKey('category_filter_FK', '{{%category_filter}}', 'category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * Down function will add migration into database table
     * @return boolean true or false
     * */
    public function safeDown()
    {
        $this->dropTable('{{%category_filter}}');
    }
}
