<?php

use yii\db\Migration;

/**
 * Class m180107_150831_add_testimonial
 */
class m180107_150831_add_testimonial extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%testimonial}}', [
            'id' => $this->primaryKey(),
            'customer' => $this->string()->notNull(),
            'designation' => $this->string()->notNull(),
            'logo' => $this->string(),
            'rating' => $this->integer(),
            'review' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%testimonial}}');
    }
}
