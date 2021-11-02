<?php

declare(strict_types=1);

namespace Lex\Yii2\User;

use Lex\Yii2\User\Provider\UserProvider;
use yii\base\InvalidArgumentException;
use Yiisoft\Auth\IdentityInterface;
use Yii;
use yii\rbac\ManagerInterface;

final class CurrentUser implements SecurityInterface
{
    private ManagerInterface $manager;

    public function __construct()
    {
        $this->manager = Yii::$app->authManager;
    }

    public function login(IdentityInterface $identity): bool
    {
        if (!($identity instanceof IdentityWithTokenInterface)) {
            throw new InvalidArgumentException('User must be implemented with ' . IdentityWithTokenInterface::class);
        }
        $user = new UserProvider($identity);
        return Yii::$app->user->login($user);
    }

    public function isGuest(): bool
    {
        return $this->getUser() instanceof GuestIdentity;
    }

    public function getUser(): IdentityInterface
    {
        /** @var UserProvider|null $user */
        $user = Yii::$app->user->getIdentity();
        return $user ? $user->getIdentity() : new GuestIdentity();
    }

    public function logout(): bool
    {
        return Yii::$app->user->logout();
    }

    public function can(string $permission, array $params = []): bool
    {
        return $this->manager->checkAccess($this->getUser()->getId(), $permission, $params);
    }
}