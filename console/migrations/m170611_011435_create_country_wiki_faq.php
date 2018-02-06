<?php

use yii\db\Migration;

class m170611_011435_create_country_wiki_faq extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%wiki_tab_faq}}', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'answer' => $this->string()->notNull(),
            'tab_id' => $this->integer()->notNull(),
            'sort_order' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('country_faq', '{{%wiki_tab_faq}}', 'tab_id');
        $this->addForeignKey('country_faq_fk', '{{%wiki_tab_faq}}', 'tab_id', '{{%countries_wiki_tabs}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('{{%wiki_tab_faq}}');
    }
}
