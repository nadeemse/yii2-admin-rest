<?php
/**
 * Created by PhpStorm.
 * User: myswich
 * Date: 05/10/15
 * Time: 04:10 م
 */


return [
    'class'               => '\filsh\yii2\oauth2server\Module',
    'tokenParamName'      => getenv('TOKEN_NAME'),
    'tokenAccessLifetime' => getenv('TOKEN_EXPIRY'),
    'storageMap'          => [
        'user_credentials' => '\common\models\OauthUser', // USer has Outh_users
    ],
    'grantTypes'          => [
        'client_credentials' => [
            'class'                => '\OAuth2\GrantType\ClientCredentials',
            'allow_public_clients' => getenv('ALLOW_PUBLIC_CLIENT'),
        ],
        'user_credentials'   => [
            'class' => 'OAuth2\GrantType\UserCredentials',
        ],
        'refresh_token'      => [
            'class'                          => '\OAuth2\GrantType\RefreshToken',
            'always_issue_new_refresh_token' => getenv('NEW_REFRESH_TOKEN'),
            'refresh_token_lifetime'         => getenv('REFRESH_TOKEN_EXPIRY'),
        ],
    ],
];