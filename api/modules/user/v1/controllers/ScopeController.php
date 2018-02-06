<?php
namespace user\v1\controllers;

use api\core\controllers\BaseRestController;
use Yii;

class ScopeController extends BaseRestController
{

    public $modelClass = '\filsh\yii2\oauth2server\models\OauthScopes';

    /**
     * responsible for authorization
     *
     * @return array
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    public function accessRules()
    {
        return [
            //Assigning scopes and permissions regarding yii\rest\ActiveController core methods
            [
                'allow'   => true,
                'actions' => ['view', 'index'],
                'roles'   => ['@'],
                'scopes'  => ['scope', 'user'],
            ],
            [
                'allow'   => true,
                'actions' => ['create', 'update'],
                'roles'   => ['@'],
                'scopes'  => ['scope', 'editor'],
            ],
            [
                'allow'   => true,
                'actions' => ['delete'],
                'roles'   => ['@'],
                'scopes'  => ['scope', 'admin'],
            ],
            [
                'allow'   => true,
                'actions' => ['options'],
                'roles'   => ['?'],
            ],
        ];
    }
}
