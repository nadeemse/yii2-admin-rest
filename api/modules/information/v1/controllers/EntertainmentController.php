<?php

namespace api\modules\information\v1\controllers;

use api\core\controllers\BaseRestController;
use api\modules\information\v1\models\EntertainmentSearch;
use common\models\Country;
use yii\helpers\ArrayHelper;

/**
 * Country Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class EntertainmentController extends BaseRestController
{
    public $modelClass = 'common\models\Entertainment';

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
                'actions' => ['options', 'listings', 'countries'],
                'roles'   => ['?'],
            ],
        ];
    }

    public function actionListings() {

        $getParams = \Yii::$app->request->queryParams;
        $postParams = \Yii::$app->getRequest()->getBodyParams();

        foreach($postParams as $key => $value) {
            if(empty($value) || $value === 'null') {
                unset($postParams[$key]);
            }
        }

        $params = ArrayHelper::merge($getParams, $postParams);

        $searchByAttr['EntertainmentSearch'] = $params;
        $searchModel = new EntertainmentSearch();

        return $searchModel->search($searchByAttr);
    }


    public function actionCountries() {

        return Country::find()
                        ->join('LEFT JOIN', 'entertainment ee', 'ee.country_id = country.id')
                        ->groupBy(['ee.country_id'])
                        ->asArray()
                        ->all();
    }
}


