<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Helper;

final class SecurityHelper
{
    public static array $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ]
    ];
}