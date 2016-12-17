<?php

$params = require(__DIR__ . '/params.php');
$modules = require(__DIR__ . '/modules.php');

$config = [
    'id' => 'app',
    'name' => 'Application',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'runtimePath' => dirname(dirname(__DIR__)) . '/runtime',
    'bootstrap' => ['log', 'courseParser'],
    'components' => [
        'courseParser'=>[
            'class'=>'app\components\CourseParser'
        ],
        'formatter' => [
            'class' => 'app\components\Formatter',
        ],
        'request' => [
            'cookieValidationKey' => 'RiAveGUdUACvWZppHVevMJRGd5Rij8uh',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
						'transport' => [
								'class' => 'Swift_SmtpTransport',
								'host' => 'smtp.gmail.com',
								'username' => 'dubztep45@gmail.com',
								'password' => 'music4lifeakars',
								'port' => '587',
								'encryption' => 'tls',
						],
        ],
        'i18n' => [
            'translations' => [
                '*' => ['class' => 'yii\i18n\PhpMessageSource'],
            ],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
						'rules' => [
								'page/<slug:.+>'=>'page/index',
								'help'=>'page/help',
								'news'=>'news/index',
								'news/<slug:.+>'=>'news/view',
								'articles'=>'article/index',
								'article/<slug:.+>'=>'article/view',

						],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => $modules,
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
