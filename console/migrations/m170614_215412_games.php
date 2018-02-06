<?php

use yii\db\Migration;

class m170614_215412_games extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%games}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'main_image' => $this->string(),
            'banner_image' => $this->string(),
            'rating' => $this->smallInteger(1)->defaultValue(0),
            'visitCount' => $this->integer()->defaultValue(0),
            'embedded_url' => $this->string()->notNull(),
            'short_description' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%games}}');
    }
}
