<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$log = require __DIR__ . '/log.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'name' => 'Selfemplo',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@uploads' => '@app/web/uploads',
        '@uploadsUrl' => '/uploads',
        '@img' => '@app/web/img',
        '@imgUrl' => '/img',
    ],
    'language' => 'es-ES',
    'components' => [

        'PayPalRestApi'=>[
            'class'=>'bitcko\paypalrestapi\PayPalRestApi',
            'redirectUrl'=>'/confirmar', // Redirect Url after payment
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gShr5RKDOaIp2-Dr_IKR4xCAwhaGg7nS',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuarios',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            
            // comment the following array to send mail using php's mail function:
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => $params['smtpUsername'],
                'password' => getenv('SMTP_PASS'),
                'port' => '587',
                'encryption' => 'tls',
            ],
        
        ],
        'log' => $log,
        'db' => $db,
        'formatter' => [
            'timeZone' => 'Europe/Madrid',
            
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'confirmar' => 'site/make-payment',
                'cookie'=> 'site/cookie',

            ],
        ],
        
    ],
    'container' => [
        'definitions' => [
            'yii\grid\ActionColumn' => ['header' => 'Acciones'],
            'yii\widgets\LinkPager' => 'yii\bootstrap4\LinkPager',
            'yii\grid\DataColumn' => 'app\widgets\DataColumn',
            'yii\grid\GridView' => ['filterErrorOptions' => ['class' => 'invalid-feedback']],
        ],
    ],
    'params' => $params,

    // Modulo datecontrol 
    'modules' => [
        'datecontrol' =>  [
            'class' => kartik\datecontrol\Module::class,
            'displayTimezone' => 'Europe/Madrid',
            'saveTimezone' => 'UTC',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ // setting for out templates
                    'default' => '@app/templates/crud/default', // template name => path to template
                ],
            ],
        ],
    ];
}

return $config;
