<?php

$params = require __DIR__ . '/params.php';
$db_config_file = file_exists(__DIR__ . '/db_local.php') ? '/db_local.php' : '/db.php';
$db = require __DIR__ . $db_config_file;

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'admin'], //'admin' -- модуль admin. в Файле Module.php  модуля admin переопределение пространства имен для консоли
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'components' => [
       //'cache' => [
       //    'class' => 'yii\caching\FileCache',
       //],
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
        'dao' => 'app\components\DaoComponent',
        'acts' => 'app\components\ActivityComponent',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false, //true,
            'viewPath' => '@app/mail',
            'enableSwiftMailerLogging' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',//Swift_SmtpTransport::class,
                'host' => 'smtp.spaceweb.ru',
                'username' => '',
                'password' => '',
                'port' => '2525', // 2525 465
                //'host' =>'smtp.yandex.ru',
                //'username' => 'geekbrains@onedeveloper.ru',
                //'password' => 'gazWSX',
                //'port' => '587', // стандартный порт шифрования
                'encryption' => 'tls'//'tls'
            ],
        ],
        'auth' => 'app\components\AuthComponent',
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'rbac' => [
            'class' => 'app\components\RbacComponent',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
