<?php

use yii\db\Migration;

class m170704_202215_news_feeder extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rss_feed}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'endPoint' => $this->string()->notNull(),
            'type' => "ENUM('news', 'video') DEFAULT 'news'",
            'sub_type' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%rss_feed}}');
    }
}
