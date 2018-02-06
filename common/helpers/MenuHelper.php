<?php

namespace common\helpers;

use yii;

/**
 * MenuHelper for left side menu render
 *
 * @author Nadeem AKhtar <nadeem@myswich.com>
 * @since 1.0
 */
class MenuHelper {

    /**
     * get Admin menu
     * this function will create admin menu with permission and return it back,
     * @return array $menuItems this is left side menu
     * */
    public static function getMenu()
    {

        return $menuItems = [

            [
                'label' => '<i class="ti-panel"></i><p>Dashboard</p>',
                'url' => ['/site/index'],
                'template' => '<a href="{url}">{label}</a>',
                'options'=>[ 'class' => (Yii::$app->controller->id == 'site' ? 'active' : '') ]
            ],


             [
                'label' => ' <i class="ti-user"></i><p>Accounts</p>',
                'url' => '#accounts',
                'items' => [

                    [
                        'label' => 'Accounts',
                        'url' => ['/account'],
                        'visible' => \Yii::$app->user->can("accounts")
                    ]

                ],
                'template' => '<a href="{url}" data-toggle="collapse" aria-expanded="true" class="">{label}</a>',
                'submenuTemplate' => "\n<div class='collapse' id='accounts'><ul class='nav'>\n{items}\n</ul></div>\n",
                'options'=> [ 'class' => ( Yii::$app->controller->id == 'account' ? 'active' : '') ]
            ],


            [
                'label' => ' <i class="fa fa-grav"></i><p>CMS</p>',
                'url' => '#cms-page',
                'items' => [

                    [
                        'label' => '<i class="fa fa-compress"></i> Contact Us',
                        'url' => ['/contact-us'],
                        'visible' => \Yii::$app->user->can("contact-us")
                    ],

                    [
                        'label' => '<i class="fa fa-bars"></i> Menu Manager',
                        'url' => ['/menu'],
                        'visible' => \Yii::$app->user->can("menu-manager")
                    ],

                    [
                        'label' => '<i class="fa fa-file-text"></i> CMS pages',
                        'url' => ['/cms-page'],
                        'visible' => \Yii::$app->user->can("cms-pages")
                    ],

                    [
                        'label' => '<i class="fa fa-file-text"></i> Testimonial',
                        'url' => ['/testimonial'],
                        'visible' => \Yii::$app->user->can("testimonial")
                    ],

                    [
                        'label' => '<i class="fa fa-user-o" aria-hidden="true"></i> Teams',
                        'url' => ['/team'],
                        'visible' => \Yii::$app->user->can("team")
                    ],

                    [
                        'label' => '<i class="fa fa-meetup"></i> Conferences',
                        'url' => ['/conference'],
                        'visible' => \Yii::$app->user->can("conferences")
                    ],

                    [
                        'label' => '<i class="fa fa-meetup"></i> Partners',
                        'url' => ['/partner'],
                        'visible' => \Yii::$app->user->can("partners")
                    ],

                    [
                        'label' => '<i class="fa fa-slideshare"></i><p>Banners</p>',
                        'url' => ['/banner'],
                    ],

                ],
                'template' => '<a href="{url}" data-toggle="collapse" aria-expanded="true" class="">{label}</a>',
                'submenuTemplate' => "\n<div class='collapse' id='cms-page'><ul class='nav'>\n{items}\n</ul></div>\n",
                'options'=> [ 'class' => ( Yii::$app->controller->id == 'cms-page' ? 'active' : '') ]
            ],

            [
                'label' => ' <i class="fa fa-video-camera"></i><p>Entertainment</p>',
                'url' => '#information-page',
                'items' => [

                    [
                        'label' => '<i class="fa fa-newspaper-o"></i><p> News </p>',
                        'url' => ['/news'],
                        'visible' => \Yii::$app->user->can("News")
                    ],

                    [
                        'label' => '<i class="fa fa-rss"></i><p> Blog </p>',
                        'url' => ['/blog'],
                        'visible' => \Yii::$app->user->can("Blogs")
                    ]
                ],
                'template' => '<a href="{url}" data-toggle="collapse" aria-expanded="true" class="">{label}</a>',
                'submenuTemplate' => "\n<div class='collapse' id='information-page'><ul class='nav'>\n{items}\n</ul></div>\n",
                'options'=> [ 'class' => ( Yii::$app->controller->id == 'cms-page' ? 'active' : '') ]
            ],


            [
                'label' => ' <i class="fa fa-map-marker" aria-hidden="true"></i> <p> localization </p>',
                'url' => '#localization',
                'items' => [

                    [
                        'label' => ' <i class="fa fa-globe"></i> Countries ',
                        'url' => ['/country'],
                        'visible' => \Yii::$app->user->can("country")
                    ],

                    [
                        'label' => ' <i class="fa fa-globe"></i> States ',
                        'url' => ['/state'],
                        'visible' => \Yii::$app->user->can("states")
                    ],

                    [
                        'label' => ' <i class="fa fa-map-marker"></i> Cities ',
                        'url' => ['/city'],
                        'visible' => \Yii::$app->user->can("cities-management")
                    ],
                    [
                        'label' => ' <i class="fa fa-area-chart"></i> Areas ',
                        'url' => ['/area'],
                        'visible' => \Yii::$app->user->can("area-management")
                    ],

                    [
                        'label' => ' <i class="fa fa-language"></i> languages',
                        'visible' => \Yii::$app->user->can("languages"),
                        'url' => ['/language'],
                    ]

                ],
                'template' => '<a href="{url}" data-toggle="collapse" aria-expanded="true" class="">{label}</a>',
                'submenuTemplate' => "\n<div class='collapse' id='localization'><ul class='nav'>\n{items}\n</ul></div>\n",
                'options'=>[ 'class' => (Yii::$app->controller->id == 'user' ? 'active' : '') ]
            ],

            [
                'label' => ' <i class="ti-settings"></i><p>System</p>',
                'url' => '#settings',
                'items' => [

                    [
                        'label' => ' <i class="fa fa-wrench"></i> Settings',
                        'url' => ['/settings'],
                    ],

                    [
                        'label' => ' <i class="fa fa-contao"></i> Contact Types',
                        'url' => ['/contact-type']
                    ]

                ],
                'template' => '<a href="{url}" data-toggle="collapse" aria-expanded="true" class="">{label}</a>',
                'submenuTemplate' => "\n<div class='collapse' id='settings'><ul class='nav'>\n{items}\n</ul></div>\n",
                'options'=>[ 'class' => (Yii::$app->controller->id == 'user' ? 'active' : '') ]
            ],

            [
                'label' => ' <i class="ti-user"></i><p>Permissions</p>',
                'url' => '#permission',
                'items' => [
                    [
                        'label' => '<i class="fa fa-user-circle"></i><p> Users </p>',
                        'url' => ['/user']
                    ],
                    [
                        'label' => '<i class="fa fa-window-restore"></i><p> Rule Assignment </p>',
                        'url' => ['/admin/assignment']
                    ],
                    [
                        'label' => '<i class="fa fa-repeat"></i><p> Routes </p>',
                        'url' => ['/admin/route']
                    ],
                    [
                        'label' => '<i class="fa fa-universal-access"></i><p> Permission </p>',
                        'url' => ['/admin/permission']
                    ],
                    [
                        'label' => '<i class="fa fa-hand-rock-o"></i><p> Roles </p>',
                        'url' => ['/admin/role']
                    ]

                ],
                'template' => '<a href="{url}" data-toggle="collapse" aria-expanded="true" class="">{label}</a>',
                'submenuTemplate' => "\n<div class='collapse' id='permission'><ul class='nav'>\n{items}\n</ul></div>\n",
                'options'=>[ 'class' => (Yii::$app->controller->id == 'user' ? 'active' : '') ]
            ],

            [
                'label' => ' <i class="ti-export"></i><p>Logout</p>',
                'url' => ['/site/logout']
            ]

        ];
    }
}
