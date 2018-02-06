<?php

namespace api\modules\information\v1\controllers;

use Yii;
use api\core\controllers\BaseRestController;

/**
 * Class BannerController
 * @package api\modules\information\v1\controllers
 */
class BannerController extends BaseRestController
{
    public $modelClass = 'common\models\Banners';

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

    /**
     * Actions function
     * */
    public function actions() {
        $actions = parent::actions();
        unset($actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    /**
     * Index action data provider
     * */
    public function prepareDataProvider() {

        $params = \Yii::$app->request->queryParams;

        $searchByAttr['Banners'] = $params;
        $searchModel = new $this->modelClass();
        return $searchModel->bannerSearch($searchByAttr);
    }
}
