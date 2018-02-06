<?php

use yii\db\Migration;

class m170809_091425_entertainment_videos extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entertainment_videos}}', [
            'id' => $this->primaryKey(),
            'entertainment_id' => $this->integer()->notNull(),
            'videoId' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'image' => $this->string()->notNull(),
            'sort_order' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex( 'video_gallery', '{{%entertainment_videos}}', 'entertainment_id');
        $this->addForeignKey( 'video_gallery_fk', '{{%entertainment_videos}}', 'entertainment_id', '{{%entertainment}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        $this->dropTable('{{%entertainment_videos}}');
    }
}
