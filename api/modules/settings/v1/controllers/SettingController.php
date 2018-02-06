<?php

namespace api\modules\settings\v1\controllers;

use api\core\controllers\BaseRestController;
use common\models\Settings;

/**
 * Country Controller API
 *
 * @author Nadeem Akhtar <nadeemakhtar.se@gmail.com>
 */
class SettingController extends BaseRestController
{
    public $modelClass = 'common\models\Settings';

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

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    /**
     * Index action data provider
     * */
    public function prepareDataProvider() {

        $setting = Settings::find()->one();
        unset($setting['id'],
            $setting['smtp_email'],
            $setting['smtp_hash'],
            $setting['smtp_username'],
            $setting['smtp_password'],
            $setting['from_email'],
            $setting['smtp_port']
        );

        return $setting;
    }

}


