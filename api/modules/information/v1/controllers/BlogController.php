<?php

namespace api\modules\information\v1\controllers;

use api\core\components\exception\RestException;
use api\core\controllers\BaseRestController;

/**
 * Country Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class BlogController extends BaseRestController
{
    public $modelClass = 'common\models\Blogs';

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


        $searchByAttr['Blogs'] = $params;
        $searchModel = new $this->modelClass();
        return $searchModel->search($searchByAttr);
    }

    /**
     * View by slug
     * @param string $slug
     * @return object $model of slug based data
     * */
    public function actionView($slug) {

        $model =  (new $this->modelClass())->find()->where(['slug' => $slug])->one();

        if($model !== null) {
            return $model;
        } else {
            return RestException::dataValidationFailed(422, 'Data not found with given page.', 422);
        }
    }
}


