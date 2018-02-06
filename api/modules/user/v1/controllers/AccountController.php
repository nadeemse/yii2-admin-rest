<?php

namespace api\modules\user\v1\controllers;

use common\models\Accounts;
use common\models\ChangePasswordForm;
use Yii;
use api\core\controllers\BaseRestController;
use yii\helpers\ArrayHelper;
use yii\web\UnauthorizedHttpException;

/**
 * Account Controller
 */
class AccountController extends BaseRestController
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
                'actions' => ['view', 'profile', 'my-items', 'update', 'account-summary', 'change-password'],
                'roles'   => ['@'],
                'scopes'  => ['account', 'profile', 'required-customer-token'],
            ],

            [
                'allow'   => true,
                'actions' => ['options', 'verify', 'verify-phone-number'],
                'roles'   => ['?'],
            ]
        ];
    }

    /**
     * Override default actions
     * */
    public function actions() {

        $actions = parent::actions();
        unset($actions['view'], $actions['update']);

        return $actions;

    }

    /**
     * @SWG\Get(path="/user/account/view",
     *     tags={"ACCOUNT"},
     *     summary="Get Account byCustomer Token",
     *     description="Customer Profile",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "token",
     *        description = "App Token",
     *        required = true,
     *        type = "string",
     *        default="04badb93a83c3beca87e1a99bbe4906143b0e1f0"
     *     ),
     *     @SWG\Parameter(
     *        in = "header",
     *        name = "customer-token",
     *        description = "Customer Token",
     *        required = true,
     *        type = "string",
     *        default = "vzo_iXzz6dNBdY35MbXFjTBEarJEDe52"
     *     ),
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "expand",
     *        description = "Expand results",
     *        required = false,
     *        type = "string",
     *        default="sellers,customers"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     )
     * )
     *
     */
    public function actionView() {
        return $this->findModel();
    }

    /**
     * @SWG\Post(path="/user/account/update",
     *     tags={"ACCOUNT"},
     *     summary="Update Customer Profile",
     *     description="Customer Profile",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "token",
     *        description = "App Token",
     *        required = true,
     *        type = "string",
     *        default="04badb93a83c3beca87e1a99bbe4906143b0e1f0"
     *     ),
     *     @SWG\Parameter(
     *        in = "header",
     *        name = "customer-token",
     *        description = "Customer Token",
     *        required = true,
     *        type = "string",
     *        default = "vzo_iXzz6dNBdY35MbXFjTBEarJEDe52"
     *     ),
     *   @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Create a new Item",
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
    public function actionUpdate() {

        $model = $this->findModel();

        $inputs = Yii::$app->getRequest()->getBodyParams();

        if($model->load($inputs, '') && $model->validate()) {
            $model->save();
            return $model;
        } else {
            return $model;
        }
    }

    /**
     * @SWG\Get(path="/user/account/verify",
     *     tags={"ACCOUNT"},
     *     summary="Verify Customer profile",
     *     description="Verify Customer profile",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "token",
     *        description = "App Token",
     *        required = true,
     *        type = "string",
     *        default="04badb93a83c3beca87e1a99bbe4906143b0e1f0"
     *     ),
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "code",
     *        description = "Verification Code",
     *        required = true,
     *        type = "string",
     *        default=""
     *     ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation"
     *   )
     * )
     *
     */
    public function actionVerify($code) {

        $model = Accounts::find()->where(['verification_code' => $code])->one();

       if( $model !== null ) {
           $model->status = 1;

           $model->verification_code = null;
           $model->save(false);
           return ['message' => 'Account has been verified.'];
       } else {
           throw new UnauthorizedHttpException('Verification code has been expired or invalid.');
       }
    }

    /**
     * @SWG\Get(path="/user/account/verify-phone-number",
     *     tags={"ACCOUNT"},
     *     summary="Verify Customer profile",
     *     description="Verify Customer profile",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "token",
     *        description = "App Token",
     *        required = true,
     *        type = "string",
     *        default="04badb93a83c3beca87e1a99bbe4906143b0e1f0"
     *     ),
     *     @SWG\Parameter(
     *        in = "query",
     *        name = "code",
     *        description = "Verification Code",
     *        required = true,
     *        type = "string",
     *        default=""
     *     ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation"
     *   )
     * )
     *
     */
    public function actionVerifyPhoneNumber($code) {

        $model = Accounts::find()->where(['phone_verification' => $code])->one();

        if( $model !== null ) {
            $model->status = 1;

            $model->phone_verification = null;
            $model->save(false);
            return ['message' => 'Dear, '. $model->first_name. ' your phone number has been verified.'];
        } else {
            throw new UnauthorizedHttpException('SMS verification code has been expired or invalid.');
        }
    }


    /**
     * Change password
     * */
    public function actionChangePassword() {

        $model = $this->findModel();

        $changePassword = new ChangePasswordForm($model->id, []);

        if($changePassword->load(Yii::$app->getRequest()->getBodyParams(), '') && $changePassword->validate()) {
            $changePassword->changePassword();
            return ['message' => 'Your password has been updated successfully.'];
        }

        return $changePassword;

    }

    /**
     * find model with customer token
     * */
    public function findModel() {


        $customer = $this->getCustomer();
        $model =  (new $this->modelClass())->find()->with('accountCountry')->where(['id' => $customer->id])->one();

        if($model !== null) {
            return $model;
        } else {
            throw new UnauthorizedHttpException('You are not allowed to perform this action.');
        }

    }
}
