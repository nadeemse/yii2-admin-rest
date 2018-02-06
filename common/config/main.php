<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        's3bucket' => [
            'class' => \frostealth\yii2\aws\s3\Storage::className(),
            'region' => getenv('AWS_REGION'),
            'credentials' => [ // Aws\Credentials\CredentialsInterface|array|callable
                'key' => getenv('AWS_KEY'),
                'secret' => getenv('AWS_SECRET'),
            ],
            'bucket' => getenv('AWS_BUCKET'),
            'cdnHostname' => 'http://example.cloudfront.net',
            'defaultAcl' => \frostealth\yii2\aws\s3\Storage::ACL_PUBLIC_READ,
            'debug' => false, // bool|array
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'dateTime' => [
            'class' => 'common\helpers\DateTimeHelper',
        ],
    ],
];
