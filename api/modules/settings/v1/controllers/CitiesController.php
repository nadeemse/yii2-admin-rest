<?php

namespace api\modules\settings\v1\controllers;

use api\core\controllers\BaseRestController;
use api\core\helpers\ArrayHelper;
use common\models\Cities;

/**
 * City Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class CitiesController extends BaseRestController
{
    public $modelClass = 'api\modules\settings\v1\models\Cities';

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
                'actions' => ['index', 'cities-by-state'],
                'roles' => ['?'],
            ],

            [
                'allow'   => true,
                'actions' => ['options'],
                'roles'   => ['?'],
            ],
        ];
    }

    public function actionCitiesByState($state_id) {
        $cities =  Cities::find()->where(['state_id' => $state_id])->all();
        return ArrayHelper::toArray($cities);
    }
}


