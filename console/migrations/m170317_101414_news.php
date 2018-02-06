<?php

use yii\db\Migration;

class m170317_101414_news extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%news}}', [
            'id'                => $this->primaryKey(),
            'title'             => $this->string()->notNull(),
            'short_description' => $this->string()->notNull(),
            'description'       => $this->text()->notNull(),
            'banner'            => $this->integer(),
            'banner_id'         => $this->integer(),
            'viewCount'         => $this->integer()->defaultValue(0),
            'commentCount'      => $this->integer()->defaultValue(0),
            'likeCount'         => $this->integer()->defaultValue(0),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),
            'created_by'        => $this->integer()->notNull(),
            'status'            => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('news_by_index', '{{%news}}', 'created_by');
        $this->addForeignKey('news_by_fk', '{{%news}}', 'created_by', 'accounts', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%news}}');
    }
}
