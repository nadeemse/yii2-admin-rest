<?php

namespace api\modules\user\v1\controllers;

use api\core\models\OauthClients;
use \yii\rest\ActiveController;
use Yii;

class ClientController extends ActiveController
{

    public $modelClass = '\api\core\models\OauthClients';

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

            [
                'allow'   => true,
                'actions' => ['options', 'index'],
                'roles'   => ['?'],
            ],
        ];
    }
}
