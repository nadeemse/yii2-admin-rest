<?php

namespace api\modules\user\v1\controllers;

use api\core\controllers\BaseRestController;
use common\models\Accounts;
use Yii;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;
use common\models\SignupForm;
use common\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use api\core\components\exception\RestException;

/**
 * Session Controller is used for user registration, login functionality, reset password
 *
 * */
class SessionController extends BaseRestController
{
    public $modelClass = 'common\models\Accounts';
    /**
     * responsible for authorization
     *
     * @return array
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    public function accessRules()
    {
        return [
            //Assigning scopes and permissions regarding yii\rest\ActiveController core methods
            [
                'allow'   => true,
                'actions' => ['create', 'reset-password', 'forgot-password', 'login', 'signup', 'facebook-login'],
                'roles'   => ['?'],
            ],
            [
                'allow'   => true,
                'actions' => ['options'],
                'roles'   => ['?'],
            ]
        ];
    }

    /**
     * Actions
     * */
    public function actions() {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    /**
     * @SWG\Post(path="/user/session/signup",
     *     tags={"SESSION"},
     *     summary="Register a new profile",
     *     description="Register a new profile",
     *     produces={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Register a new profile",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Profile")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(ref="#/definitions/Profile")
     *   )
     * )
     *
     */
    public function actionCreate() {

        $inputs = Yii::$app->getRequest()->getBodyParams();

        $model = new SignupForm(['scenario' => 'self']);
        if ($model->load($inputs, '') && $model->validate()) {

            if ($user = $model->signup()) {

                if (Yii::$app->getUser()->login($user)) {
                    return ['auth_key' => Yii::$app->user->identity->getAuthKey()];

                }
            }
        }

        $model->validate();
        return $model;

    }

    /**
     * @SWG\Post(path="/user/session/facebook-login",
     *     tags={"SESSION"},
     *     summary="Login with facebook",
     *     description="Login with facebook",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "Customer email",
     *        required = true,
     *        type = "string",
     *        default="nadeemakhtar.se@gmail.com"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "socialType",
     *        description = "Social Type",
     *        required = true,
     *        type = "string",
     *        default = "facebook"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "socialID",
     *        description = "Social ID",
     *        required = false,
     *        type = "string",
     *        default="0"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     )
     * )
     *
     */
    public function actionFacebookLogin() {

        $inputs = Yii::$app->getRequest()->getBodyParams();
        $model = new SignupForm(['scenario' => 'facebook']);

        $model->load($inputs, '');

        // Check if user already exist then simply login
        $account = Accounts::find()->where(['socialType' => $model->scenario, 'socialID' => $model->socialID ])->one();

        //If user not exist then allow him to create and login
        if($account !== null) {
            return ['auth_key' => $account->auth_key];
        }

        if ($model->load($inputs, '') && $model->validate()) {

            if ($user = $model->signup()) {

                if (Yii::$app->getUser()->login($user)) {
                    return ['auth_key' => Yii::$app->user->identity->getAuthKey()];

                }
            }
        }

        $model->validate();
        return $model;

    }


    /**
     * @SWG\Post(path="/user/session/login",
     *     tags={"SESSION"},
     *     summary="Login to account",
     *     description="Login to account",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "Customer email",
     *        required = true,
     *        type = "string",
     *        default="nadeemakhtar.se@gmail.com"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "Account Password",
     *        required = true,
     *        type = "string",
     *        default = "admin123"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "rememberMe",
     *        description = "Remeber me or not",
     *        required = false,
     *        type = "string",
     *        default="0"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     )
     * )
     *
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        $inputs = Yii::$app->getRequest()->getBodyParams();

        if ($model->load($inputs, '') && $model->login()) {
            return ['auth_key' => Yii::$app->user->identity->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }

    /**
     * @SWG\Post(path="/user/session/forgot-password",
     *     tags={"SESSION"},
     *     summary="Forgot your password",
     *     description="Forgot your password",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "email",
     *        description = "Customer email",
     *        required = true,
     *        type = "string",
     *        default="nadeemakhtar.se@gmail.com"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     )
     * )
     *
     */
    public function actionForgotPassword() {

        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()) {

            if ($model->sendEmail()) {
                return [
                    'message' => 'Check your email for further instructions',
                ];
            } else {
               return RestException::parametersNotValid('Sorry, we are unable to reset password for email provided');
            }
        }

        return $model;
    }

    /**
     * @SWG\Post(path="/user/session/reset-password",
     *     tags={"SESSION"},
     *     summary="Reset  your password",
     *     description="Reset  your password",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "New Password",
     *        required = true,
     *        type = "string",
     *        default=""
     *     ),
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "password_token",
     *        description = "Password reset token",
     *        required = true,
     *        type = "string",
     *        default=""
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     )
     * )
     *
     */
    public function actionResetPassword($password_token)
    {

        try {
            $model = new ResetPasswordForm($password_token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->validate() && $model->resetPassword()) {

            return ['message' => 'Your password has been updated successfully.'];
        }

        return $model;
    }

}
