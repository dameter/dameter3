<?php

$params = require __DIR__ . '/params.php';
$credentials = require __DIR__ . '/credentials.php';
$log = require __DIR__ . '/log.php';

return [

    'log' => $log,
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
    ],
    'user' => [
        'class' => \dameter\app\models\User::class,
        'identityClass' => \dameter\app\models\User::class,
        'enableAutoLogin' => true,
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
        'fileMode' => 0777,
        'dirMode' => 0777,
    ],


    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => $credentials['cookieValidationKey'],
    ],


    'mailer' => $credentials['mailer'],
    'db' => $credentials['db'],

];
