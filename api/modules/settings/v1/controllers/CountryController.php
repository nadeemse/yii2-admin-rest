<?php

namespace api\modules\settings\v1\controllers;

use api\core\controllers\BaseRestController;
use api\core\helpers\ArrayHelper;
use api\modules\catalog\v1\models\Items;
use api\modules\settings\v1\models\Country;
use common\models\States;

/**
 * Country Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class CountryController extends BaseRestController
{
    public $modelClass = 'api\modules\settings\v1\models\Country';

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
                'actions' => ['available-country', 'index', 'states', 'available-countries'],
                'roles' => ['?'],
            ],

            [
                'allow'   => true,
                'actions' => ['options'],
                'roles'   => ['?'],
            ],
        ];
    }

    /**
     * Action
     * */
    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Index function that will return all country lists
     * @return array of objects
     * */
    public function actionIndex() {

        $params = \Yii::$app->request->queryParams;

        $searchByAttr['Country'] = $params;
        $searchModel = new $this->modelClass();
        return $searchModel->search($searchByAttr);

    }

    /**
     * Index function that will return all country lists
     * @return array of objects
     * */
    public function actionAvailableCountries() {

        $countries = Country::find()
            ->with('cities')
            ->join('INNER JOIN', 'items i', 'country.id = i.country_id')
            ->groupBy('i.country_id')
            ->all();

        $returnData = [];
        foreach($countries as $key => $country) {
            $returnData[$key] = $country->toArray();
            $returnData[$key]['cities'] = ArrayHelper::toArray($country->cities);
        }

        return ArrayHelper::toArray($returnData);
    }

    /**
     * @param $country_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionStates($country_id) {

        $states = States::find()->where(['country_id' => $country_id])->all();

        return ArrayHelper::toArray($states);
    }
}


