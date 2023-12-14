<?php
$params = require(__DIR__ . '/params.php');

return [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'logFile'=> '@runtime/logs/error.log',
            'levels' => ['error', 'warning'],
        ],
        [
            'class' => 'yii\log\FileTarget',
            'logFile'=> '@runtime/logs/app.log',
            'categories' => ['app\*'],
            // do not log context
            'logVars' => [],
            'levels' => ['info'],
        ],
    ],
];