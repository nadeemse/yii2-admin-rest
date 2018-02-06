<?php

namespace api\modules\information\v1\controllers;

use api\core\components\exception\RestException;
use api\core\controllers\BaseRestController;

/**
 * Country Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class PageController extends BaseRestController
{
    public $modelClass = 'api\modules\information\v1\models\CmsPages';

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
        return $actions;
    }

    /**
     * View by slug
     * @param string $slug
     * @return object $model of slug based data
     * */
    public function actionView($slug) {

        $model =  (new $this->modelClass())->find()->where(['seo_url' => $slug])->one();

        if($model !== null) {
            return $model;
        } else {
            return RestException::dataValidationFailed(422, 'Data not found with given page.', 422);
        }
    }
}


