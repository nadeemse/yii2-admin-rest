<?php
namespace api\core\components\rest;

use yii\rest\UrlRule;
use Yii;

class RestUrlRule extends UrlRule
{
    public $pluralize = false;

    /**
     * Override init function
     *
     * @return void
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    public function init()
    {
        $this->tokens = [
            '{id}' => '<id:[\w]+>',
        ];

        parent::init();
    }
}
