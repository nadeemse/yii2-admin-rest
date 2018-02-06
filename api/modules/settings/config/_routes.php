<?php
return [
    'settings' => [
        'v1' => [
            'page' => [
                'controller'    => 'page',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                    ],
            ],
            'country' => [
                'controller'    => 'country',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                        'GET states' => 'states',
                        'GET available-countries' => 'available-countries',
                    ],
            ],
            'time-category' => [
                'controller'    => 'time-category',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                    ],
            ],
            'package' => [
                'controller'    => 'package',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                    ],
            ],
            'contact-type' => [
                'controller'    => 'contact-type',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                    ],
            ],
            'condition' => [
                'controller'    => 'condition',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                    ],
            ],
            'uses' => [
                'controller'    => 'uses',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                    ],
            ],
            'cities' => [
                'controller'    => 'cities',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                        'GET cities-by-state' => 'cities-by-state'
                    ],
            ],
            'areas' => [
                'controller'    => 'areas',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                        'GET areas-by-city'    => 'areas-by-city',
                    ],
            ],
            'setting' => [
                'controller'    => 'setting',
                'extraPatterns' =>
                    [
                        'OPTIONS <action:(.*)>'    => 'options',
                    ],
            ]
        ],
        'v2' => [
            'inherit-from' => 'v1',
        ],
    ],
];
