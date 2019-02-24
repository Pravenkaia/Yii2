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
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //'cache' => [
        //    'class' => 'yii\caching\MemCache',
        //    'servers' => [
        //        [
        //            'host' => 'localhost',
        //            'port' => 11211,
        //        ],
        //    ]
        //],

        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' =>  'auth/sign-in',//['user/login']
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
        // ЧПУ-адреса
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
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