<?php

declare(strict_types=1);

use HttpSoft\Message\RequestFactory;
use HttpSoft\Message\ResponseFactory;
use HttpSoft\Message\ServerRequestFactory;
use HttpSoft\Message\StreamFactory;
use HttpSoft\Message\UploadedFileFactory;
use HttpSoft\Message\UriFactory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Lex\Yii2\User\Repository\UserRepositoryInterface;
use Lex\Yii2\User\SecurityInterface;
use Lex\Yii2\User\Tests\Repository\UserRepository;
use Lex\Yii2\User\ViewInjection\UserViewInjection;
use Lex\Yii2\User\Provider\SecurityService;
use Lex\Yii2\User\Provider\UserProvider;

return [
    'id' => 'yii-tests',
    'basePath' => __DIR__,
    'controllerNamespace' => 'Lex\\User\\Tests\\Controller',
    'aliases' => [
        '@web/assets' => __DIR__,
        '@webroot/assets' => __DIR__ . DIRECTORY_SEPARATOR . '.phpunit.cache/yii/assets'
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'scriptUrl' => 'index.php'
        ],
        'view' => [
            'class' => View::class,
            'injections' => [
                UserViewInjection::class
            ]
        ],
        'user' => [
            'identityClass' => UserProvider::class
        ]
    ],
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'container' => [
        'definitions' => [
            SecurityInterface::class => SecurityService::class,
            RequestFactoryInterface::class => RequestFactory::class,
            ServerRequestFactoryInterface::class => ServerRequestFactory::class,
            ResponseFactoryInterface::class => ResponseFactory::class,
            StreamFactoryInterface::class => StreamFactory::class,
            UriFactoryInterface::class => UriFactory::class,
            UploadedFileFactoryInterface::class => UploadedFileFactory::class,
            UserRepositoryInterface::class => UserRepository::class
        ]
    ]
];