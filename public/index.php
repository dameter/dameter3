<?php
include __DIR__  .'/../env.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new \dameter\app\DameterWebApplication($config))->run();