<?php

use yii\db\Migration;

class m170220_182304_blog_comments extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_comments}}', [
            'id' => $this->primaryKey(),
            'blog_id' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'parent_id' => $this->integer()->notNull(),
            'comment' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('blog_comment_index', '{{%blog_comments}}', 'blog_id');
        $this->addForeignKey('blog_comment_fk', '{{%blog_comments}}', 'blog_id', 'blogs', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('comment_creator', '{{%blog_comments}}', 'created_by');
        $this->addForeignKey('comment_creator_fk', '{{%blog_comments}}', 'created_by', 'accounts', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%blog_comments}}');
    }
}
