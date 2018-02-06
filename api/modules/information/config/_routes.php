<?php
return [
    'information' => [
        'v1' => [
            'page' => [
                'controller' => 'page',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>' => 'options',
                        'GET view/<slug>' => 'view'
                    ],
            ],
            'blog' => [
                'controller' => 'blog',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>' => 'options',
                        'GET view/{slug}' => 'view'
                    ],
            ],
            'banner' => [
                'controller' => 'banner',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>' => 'options',
                    ],
            ],
            'menu' => [
                'controller' => 'menu',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>' => 'options',
                        'GET mega-menu' => 'mega-menu',
                    ],
            ],
            'news' => [
                'controller' => 'news',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>' => 'options',
                        'GET view/{slug}' => 'view'
                    ],
            ],

            'contact-us' => [
                'controller' => 'contact-us',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>' => 'options'
                    ],
            ],
            'language' => [
                'controller' => 'language',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>' => 'options'
                    ],
            ],
        ],
        'v2' => [
            'inherit-from' => 'v1',
        ],
    ],
];
