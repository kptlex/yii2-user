<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Provider;

use Yii;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\di\Container;
use yii\di\NotInstantiableException;
use yii\web\IdentityInterface as YiiIdentity;
use Lex\Yii2\User\IdentityWithTokenInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Auth\IdentityWithTokenRepositoryInterface;

final class UserProvider implements YiiIdentity
{
    private ?IdentityWithTokenInterface $identity;

    public function __construct(?IdentityWithTokenInterface $identity = null)
    {
        $this->identity = $identity;
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id): ?self
    {
        $container = self::getContainer();
        /** @var IdentityRepositoryInterface $repository */
        try {
            $repository = $container->get(IdentityRepositoryInterface::class);
        } catch (NotInstantiableException $e) {
            return null;
        } catch (InvalidConfigException $e) {
            return null;
        }
        $identity = $repository->findIdentity((string)$id);
        return $identity ? new self($identity) : null;
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null): ?self
    {
        $container = self::getContainer();
        try {
            /** @var IdentityWithTokenRepositoryInterface $repository */
            $repository = $container->get(IdentityWithTokenRepositoryInterface::class);
        } catch (NotInstantiableException $e) {
            return null;
        } catch (InvalidConfigException $e) {
            return null;
        }
        $identity = $repository->findIdentityByToken($token, $type);
        if ($identity) {
            if ($identity instanceof IdentityWithTokenInterface) {
                return new self($identity);
            }
            throw new InvalidArgumentException('User must be implemented with ' . IdentityWithTokenInterface::class);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->identity->getId();
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey(): ?string
    {
        return $this->getIdentity()->getAuthKey();
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Get current user entity.
     * @return IdentityWithTokenInterface
     */
    public function getIdentity(): IdentityWithTokenInterface
    {
        return $this->identity;
    }

    private static function getContainer(): Container
    {
        return Yii::$container;
    }
}