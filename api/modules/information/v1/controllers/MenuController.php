<?php

namespace api\modules\information\v1\controllers;

use api\core\components\exception\RestException;
use api\core\controllers\BaseRestController;
use api\modules\information\v1\models\CountriesWikiTabs;
use api\modules\information\v1\models\Menu;

/**
 * Country Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class MenuController extends BaseRestController
{
    public $modelClass = 'api\modules\information\v1\models\Menu';

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
                'allow' => true,
                'actions' => ['mega-menu'],
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
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionMegaMenu() {


        $params = \Yii::$app->request->queryParams;

        $searchByAttr['Menu'] = $params;
        $searchModel = new Menu();
        $searchModel->parentOnly = true;

        return $searchModel->search($searchByAttr);
    }
}


