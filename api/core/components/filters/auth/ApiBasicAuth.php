<?php

namespace api\core\components\filters\auth;


use common\models\Customer;
use yii\filters\auth\HttpBasicAuth;

class ApiBasicAuth extends HttpBasicAuth
{

    public $tokenParam = 'customer-token';
    /**
     * @inheritdoc
     */
    public function authenticate($customer, $request, $response)
    {
        $accessToken = $request->headers[$this->tokenParam];

        if (is_string($accessToken)) {

            $identity = $customer->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }

        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

       return false;
    }
}
