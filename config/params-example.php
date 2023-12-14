<?php

return [
    'adminEmail' => 'tonis@andmemasin.eu',
    'siteName'=>'survey-app-modules',
    'timeZone' => 'Europe/Tallinn',

    // this is needed to be set STATICALLY for console actions
    'baseUrl'=>'http://localhost:8084',
    //'icon-framework' => 'fa',

    //theTest SQL file paths
    'testSQLDumpCollector'=>   'modules/andmemasin/collector/tests/_data/dump.sql',
    'DB_DATABASE'=>'surveyapp',
    'DB_TEST_DATABASE'=>'peko_test',
    'DB_HOST'=>'localhost',
    'DB_USERNAME'=>'root',
    'DB_PASSWORD'=>'root',

    'googleApiKey' => '',
    'developmentIps' =>['*'],

    'cloudwatch' => [
        'key' => '',
        'secret' => '',
        'region' => 'eu-north-1',
        'logGroupName' => 'survey-apps',
        'logStreamName' => 'app-module',
        'levels' => [
            'info',
            'notice',
            'warning',
            'error',
            'critical',
            'alert',
            'emergency',
        ],
    ],

];
