<?php

declare(strict_types=1);

namespace Lex\Yii2\User;

use Yiisoft\Auth\IdentityInterface;

interface SecurityInterface
{
    public function isGuest(): bool;

    public function getUser(): IdentityInterface;

    public function login(IdentityInterface $identity): bool;

    public function logout(): bool;

    public function can(string $permission, array $params = []): bool;
}