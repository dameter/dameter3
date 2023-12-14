<?php

$params = require_once(__DIR__ . '/params.php');
$aliases = require __DIR__ . '/aliases.php';
$log = require __DIR__ . '/log.php';

$config = [
    'id' => 'dameter-app',
    'name' => 'dameter-app',
    'aliases' => $aliases,
    'basePath' => dirname(__DIR__)."/src",
    'runtimePath' => dirname(__DIR__) . '/runtime',
    'controllerNamespace' => "dameter\app\controllers",
    'defaultRoute'=>'survey/index',
    'language' =>'et',
    'bootstrap' => ['log'],

    'components' => [
        'log' => $log,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => \dameter\app\models\User::class,
            'enableAutoLogin' => true,
        ],
        'request' =>[
            'cookieValidationKey' => 'test'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'fileMode' => 0777,
            'dirMode' => 0777,
        ],

    ],
    'params' => $params

];

// configuration adjustments for 'dev' environment


if (YII_ENV_DEV) {
    $config['bootstrap'][] ='debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
