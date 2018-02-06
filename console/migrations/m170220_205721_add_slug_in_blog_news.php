<?php

use yii\db\Migration;

class m170220_205721_add_slug_in_blog_news extends Migration
{
    public function up()
    {
        $this->addColumn('blogs', 'slug', "VARCHAR(255) DEFAULT NULL ");
        $this->addColumn('news', 'slug', "VARCHAR(255) DEFAULT NULL ");

        $this->alterColumn('blogs', 'banner', "VARCHAR(255) DEFAULT NULL ");
        $this->alterColumn('news', 'banner', "VARCHAR(255) DEFAULT NULL ");

    }

    public function down()
    {
        $this->dropColumn('blogs', 'slug');
        $this->dropColumn('news', 'slug');

        $this->alterColumn('blogs', 'banner', "INT(11) DEFAULT NULL ");
        $this->alterColumn('news', 'banner', "INT(11) DEFAULT NULL ");
    }

}
