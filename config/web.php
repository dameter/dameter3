<?php

$params = require_once(__DIR__ . '/params.php');
$aliases = require_once(__DIR__ . '/aliases.php');
$components = require_once(__DIR__ . '/components.php');

$config = [
    'id' => 'respund-collector',
    'name' => 'respund-collector',
    'aliases' => $aliases,
    'basePath' => dirname(__DIR__)."/src",
    'runtimePath' => dirname(__DIR__) . '/runtime',
    'controllerNamespace' => "respund\collector\controllers",
    'defaultRoute'=>'survey/index',
    'language' =>'et',
    'bootstrap' => ['log'],

    'components' => $components,
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
