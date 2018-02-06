<?php

use yii\db\Migration;

class m170611_011430_create_country_wiki_tabs extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%countries_wiki_tabs}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'banner' => $this->string(),
            'description' => $this->string()->notNull(),
            'country_wiki_id' => $this->integer()->notNull(),
            'sort_order' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('country_wiki_faq', '{{%countries_wiki_tabs}}', 'country_wiki_id');
        $this->addForeignKey('country_wiki_faq_fk', '{{%countries_wiki_tabs}}', 'country_wiki_id', '{{%countries_wiki}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('{{%countries_wiki_tabs}}');
    }
}
