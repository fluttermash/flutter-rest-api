<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
                           'request' => [
            'csrfParam' => '_csrf-frontend',
             'class' => 'common\components\Request',
    'web'=> '/frontend/web'
//            'baseUrl'=>'/',
        ],
        
        
             'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=flutter-rest-api-database',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
        
               'jwt'=> [
            'class'=>'\common\components\JwtService',
            'privateKey'=>'EGSJJQjk4LknVgALyUKHttItDJmoEfrHTlmTD2YSQGRIxr5rr7fet'
        ],
        
    ],
];
