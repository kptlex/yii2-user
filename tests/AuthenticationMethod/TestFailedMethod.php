<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\AuthenticationMethod;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Auth\AuthenticationMethodInterface;
use Yiisoft\Auth\IdentityInterface;

final class TestFailedMethod implements AuthenticationMethodInterface
{

    public function authenticate(ServerRequestInterface $request): ?IdentityInterface
    {
        return null;
    }

    public function challenge(ResponseInterface $response): ResponseInterface
    {
        return $response;
    }
}