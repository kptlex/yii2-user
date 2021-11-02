<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Repository;

use Lex\Yii2\User\Entity\UserInterface;
use Lex\Yii2\User\Repository\UserRepositoryInterface;
use Lex\Yii2\User\Tests\Entity\User;
use Lex\Yii2\User\Tests\Helper\SecurityHelper;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Auth\IdentityWithTokenRepositoryInterface;

final class UserRepository implements IdentityRepositoryInterface, IdentityWithTokenRepositoryInterface
{
    public function findIdentity($id): ?IdentityInterface
    {
        $user = SecurityHelper::$users[$id] ?? null;
        if ($user) {
            return $this->getUser($user);
        }
        return null;
    }

    public function findIdentityByAccessToken(string $token, string $type = null): ?IdentityInterface
    {
        foreach (SecurityHelper::$users as $user) {
            if ($user['accessToken'] === $token) {
                return $this->getUser($user);
            }
        }
        return null;
    }

    private function getUser(array $data): User
    {
        return new User($data['id'], $data['authKey'], $data['username'], $data['password'], $data['accessToken']);
    }

    public function findIdentityByToken(string $token, string $type = null): ?IdentityInterface
    {
        // TODO: Implement findIdentityByToken() method.
    }
}