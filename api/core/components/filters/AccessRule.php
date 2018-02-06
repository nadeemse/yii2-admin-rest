<?php

namespace api\core\components\filters;

class AccessRule extends \yii\filters\AccessRule
{
    /** @var array list of scopes, used for setting scope for controller */
    public $scopes = [];
}
