<?php

return [
    'cookieValidationKey' => 'example-key1',
    'mailer' => [
        'class' => \yii\symfonymailer\Mailer::class,
        'viewPath' => '@app/mail',
        'useFileTransport' => true,
        /*
        'transport' => [
            'scheme' => 'smtp',
            'host' => 'email-smtp.eu-north-1.amazonaws.com',
            'username' => 'user',
            'password' => 'passs',
            'port' => 2587,
            'encryption' => 'tls',
        ],
        */
    ],

    'developmentIps'=>[
        '127.0.0.1',
        '::1',
    ],
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=dameter_db;dbname=app',
        'username' => 'root',
        'password' => 'password',
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        'enableSchemaCache' => true,
        'schemaCacheDuration' => 3600,
        'schemaCache' => 'cache',

        'enableQueryCache' => false,
        'queryCache' => 'cache',
    ]


];
