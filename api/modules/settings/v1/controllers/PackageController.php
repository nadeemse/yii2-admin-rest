<?php

namespace api\modules\settings\v1\controllers;

use api\core\controllers\BaseRestController;

/**
 * Country Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class PackageController extends BaseRestController
{
    public $modelClass = 'common\models\Packages';

    /**
     * responsible for authorization
     *
     * @return array
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     */
    public function accessRules()
    {
        return [
            //Assigning scopes and permissions regarding yii\rest\ActiveController core methods
            [
                'allow' => true,
                'roles' => ['?'],
            ],

            [
                'allow'   => true,
                'actions' => ['options'],
                'roles'   => ['?'],
            ],
        ];
    }
}


