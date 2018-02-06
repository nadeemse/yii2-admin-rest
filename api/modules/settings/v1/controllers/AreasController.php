<?php

namespace api\modules\settings\v1\controllers;

use api\core\controllers\BaseRestController;
use api\modules\settings\v1\models\Areas;
use api\modules\settings\v1\models\Cities;
use yii\helpers\ArrayHelper;

/**
 * Area Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class AreasController extends BaseRestController
{
    public $modelClass = 'api\modules\settings\v1\models\Areas';

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

            [
                'allow' => true,
                'actions' => ['areas-by-city'],
                'roles' => ['?'],
            ],

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

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['index']);

        return $actions;
    }

    /**
     * Action Index
     * */
    public function actionIndex() {

        $params = \Yii::$app->request->queryParams;

        $searchByAttr['Areas'] = $params;

        $searchModel = new $this->modelClass();

        if($params['city']) {
            $city = Cities::findOne(['name' => $params['city']]);
            if($city !== null) {
                $searchModel->city_id = $city->id;
            }
        }

        return $searchModel->search($searchByAttr);

    }


    /**
     * Action Index
     * */
    public function actionAreasByCity($city_id) {
        $areas = Areas::find()->where(['city_id' => $city_id])->all();
        return ArrayHelper::toArray($areas);
    }
}


