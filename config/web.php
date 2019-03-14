<?php

$params = require __DIR__ . '/params.php';
/**
 * в переменной задается файл конфигурации БД
 * $db_local с реальными настройками сервера
 * $db из под root и без пароля
 **/
//$db_config_file = '/db_local.php';
$db_config_file = file_exists(__DIR__ . '/db_local.php') ? '/db_local.php' : '/db.php';
$db = require __DIR__ . $db_config_file;
//$db = require __DIR__ . '/db.php'; // исходнаяя настройка

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',

    'bootstrap' => ['log'],
    'container' => [
        'singletons' => [
            'app\components\interfaces\NotificationInterface'
            => ['class' => '\app\components\NotificationService'],
        ]
    ],
    //'defaultRoute'=>'activity',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@activity' => '@app/modules/activity', // для модуля activity
    ],


    //модули
    'modules' => [
        //        'activity' => [
        //            'class' => 'app\modules\activity\Module',
        //        ],
        //  ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'as access' => [ // if you need to set access
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'] // all auth users
                    ],
                ]
            ],
        ],
    ],

    // компоненты
    'components' => [
        'dao' => 'app\components\DaoComponent',
        'acts' => 'app\components\ActivityComponent',
        'auth' => 'app\components\AuthComponent',
        'authManager' => 'yii\rbac\DbManager',
        'rbac' => [
            'class' => 'app\components\RbacComponent',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CNEQGE_XzvJU7dfAmDxrM9fZ2GMBvicG',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ],
        ],
        // 'cache' => [
        //     'class' => 'yii\caching\FileCache',
        // ],
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true,
            // 'servers' => [
            //     [
            //         'host' => 'localhost',
            //         'port' => 11211,
            //     ],
            // ]
        ],

        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => 'auth/sign-in',//['user/login']
        ],
        'users' => 'app\components\UsersComponent',
        //'user' => [  // настройки из коробкм
        //    'identityClass' => 'app\models\User',
        //    'enableAutoLogin' => true,
        //],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        //создаем папку messages с папками языков
        //создаем файл app.php храним переводы в файле
        'i18n' => [
            'translations' => [
                'class' => \yii\i18n\PhpMessageSource::class,
                'fileMap' => [
                    'app' => 'app.php',
                    'app/error' => 'error.php',
                ]
            ]

        ],



        // ЧПУ-адреса
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,  // из методички
            'rules' => [
                //'catchAll' => ['site/index'], // из методички не работает
                'reg' => 'auth/sign-up',
                'login' => 'auth/sign-in',
                //[
                ////    'class' => 'yii\web\UrlRule',
                //    'calendar/<action:index|day>' => 'calendar/<action>',
                //    'calendar/day/<year:\d+>/<month:\d+>/<day:\d+>/' => 'calendar/day',
                //    'calendar/<year:\d+>/<month:\d+>' => 'calendar/index',
                //    'calendar/<year:\d+>' => 'calendar/index',
//
                //    'calendar' => 'calendar/index',
                //],
                //'calendar/day/<year:\d{4}>/<month:\d+>/<day:\d+>/' => 'calendar/day',
                //[
                //    'class'=>'app\components\CalendarUrlClass'
                //],
                [
                    'pattern' => 'calendar/<year:\d+>/<month:\d+>/<day:\d+>/<action:index|day>',
                    'route' => 'calendar/<action>',
                    'defaults' => ['year' => '', 'month' => '', 'day' => ''],

                ],
                'events' => 'activity/index',
                'events/view/<id:\d+>' => 'activity/view',
                'events/delete/<id:\d+>' => 'activity/delete',
                'events/update/<id:\d+>' => 'activity/update',
                'events/create/<id:\d+>' => 'activity/create',
                //'events/view/<id:\w+>' => 'activity/view', //текстовые URL. В БД создается поле с уникальным значением этого текстового URL адреса
                'events/<action>' => 'activity/<action>',


                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'activity-rest',
                    'pluralize' => false, // запрещает создавать едниственное-множественное число для сущности. У нас одна Activity (Например, Activities - Activity)
                ], //вместе с этим редактируем компонент request: добавляем parser (см. components)
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'], //['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'], //['127.0.0.1', '::1'],
    ];
}

return $config;
