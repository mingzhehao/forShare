<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','gii'],
    'language' => 'zh-CN',
    'modules' => [
        'gii' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '61.148.75.238'],
        // ...
        'Post' => [
        ],
        'User' => [
            'class' => 'app\modules\user\Module',//大写User处理module模块，user是后台管理使用
        ],

        /**admin后台 rbac**/
        'rbac-admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // default null. other avaliable value 'right-menu' and 'top-menu'
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'id'
                ]
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'route' => 'route', // disable menu
                //'route' => null, // disable menu
            ],
        ],

        // ...
        'markdown' => [
            // the module class
            'class' => 'kartik\markdown\Module',

            // the controller action route used for markdown editor preview
            'previewAction' => '/markdown/parse/preview',

            // the controller action route used for downloading the markdown exported file
            'downloadAction' => '/markdown/parse/download',

            // the list of custom conversion patterns for post processing
            'customConversion' => [
                '<table>' => '<table class="table table-bordered table-striped">'
            ],

            // whether to use PHP SmartyPantsTypographer to process Markdown output
            'smartyPants' => true,

            // array the the internalization configuration for this module
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@markdown/messages',
                'forceTranslation' => true
            ],
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Etqv9H2EbU4K4wIuUKnP62va3hL6bAEF',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'memcache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 12321,
                    'weight' => 100,
                ],
                [
                    'host' => '127.0.0.1',
                    'port' => 12321,
                    'weight' => 50,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',//调整了
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
            'defaultRoles' => ['admin', 'author'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' =>  [
                        'User/<id:\d+>'=>'User/home',
                        'User/<id:\d+>/show'=>'User/home/show',//用户基本信息展示
                        'User/setting'=>'User/home/setting',
                        'User/avatar'=>'User/home/avatar',
                ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
                'rbac-admin/*', // add or remove allowed actions to this list
                'site/*',
                'User/*',
                'gii/*',
                'admin/*',
                'topic-admin/*',
                'music/*',
                'humour/*',
                'upload/*',
                'crud/*',
                'comment/*',
                'markdown/parse/download',//需要开启,不然影响markdown
                'test/*',
                'vote/*',
        ]
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '61.148.75.238'],
    ];
}

return $config;
