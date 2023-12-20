<?php

$params = require __DIR__ . '/params.php';
$credentials = require __DIR__ . '/credentials.php';
$log = require __DIR__ . '/log.php';

return [

    'log' => $log,
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            '/s/<key:[\w-]+>' => 'survey/index',
            '/go/<key:[\w-]+>' => 'survey/respondent',
            '/edit/<key:[\w-]+>' => '/admin/survey/update',
        ],
    ],
    'user' => [
        'identityClass' => "todo",
        'enableAutoLogin' => true,
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
        'fileMode' => 0777,
        'dirMode' => 0777,
    ],
    'view' => \respund\collector\app\View::class,

    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => $credentials['cookieValidationKey'],
    ],


    'mailer' => $credentials['mailer'],
    'db' => $credentials['db'],

];
