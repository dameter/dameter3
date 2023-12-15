<?php

$params = require_once(__DIR__ . '/params.php');
$aliases = require_once(__DIR__ . '/aliases.php');
$components = require_once(__DIR__ . '/components.php');

$config = [
    'id' => 'dameter-app',
    'name' => 'dameter-app',
    'aliases' => $aliases,
    'basePath' => dirname(__DIR__)."/src",
    'runtimePath' => dirname(__DIR__) . '/runtime',
    'controllerNamespace' => "dameter\app\commands",
    'language' =>'et',
    'bootstrap' => ['log'],

    'components' => $components,
    'params' => $params

];
unset($config['components']['request']);
unset($config['components']['user']);
return $config;
