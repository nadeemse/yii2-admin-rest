<?php

use yii\db\Migration;

class m170610_074538_create_country_wiki extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%countries_wiki}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'flag' => $this->string()->notNull(),
            'banner' => $this->string(),
            'sort_order' => $this->integer(),
            'description' => $this->text(),
            'short_description' => $this->string(),
            'meta_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%countries_wiki}}');
    }
}
