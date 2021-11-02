<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\AuthenticationMethod;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Lex\Yii2\User\Tests\Repository\UserRepository;
use Yiisoft\Auth\AuthenticationMethodInterface;
use Yiisoft\Auth\IdentityInterface;

final class TestSuccessMethod implements AuthenticationMethodInterface
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository, bool $withSuccessMethod)
    {
        $this->repository = $repository;
    }

    public function authenticate(ServerRequestInterface $request): ?IdentityInterface
    {
        return $this->repository->findIdentity(100);
    }

    public function challenge(ResponseInterface $response): ResponseInterface
    {
        return $response;
    }
}