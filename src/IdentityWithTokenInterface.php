<?php

declare(strict_types=1);

namespace Lex\Yii2\User;

use Yiisoft\Auth\IdentityInterface;

interface IdentityWithTokenInterface extends IdentityInterface
{
    /**
     * @return string|null
     * @see \yii\web\IdentityInterface::getAuthKey()
     */
    public function getAuthKey():?string;
}