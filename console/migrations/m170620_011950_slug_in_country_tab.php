<?php

use yii\db\Migration;

class m170620_011950_slug_in_country_tab extends Migration
{
    public function up()
    {
        $this->addColumn('{{%countries_wiki_tabs}}', 'slug', "VARCHAR(255) DEFAULT NULL");

        // Set referral keys for all customers
        $updateCustomer = "UPDATE countries_wiki_tabs SET `slug` = REPLACE( LOWER(TRIM(`title`)) , ' ' , '-' )";
        $this->execute($updateCustomer);

    }

    public function down()
    {
        $this->dropColumn('{{%countries_wiki_tabs}}', 'slug');
    }
}
