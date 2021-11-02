<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Security;

use PHPUnit\Framework\TestCase;
use Lex\Yii2\User\Provider\UserProvider;
use Yii;

final class YiiIdentityTest extends TestCase
{
    public function testFindIdentity()
    {
        /** @var UserProvider $identityClass */
        $identityClass = Yii::$app->user->identityClass;
        $user = $identityClass::findIdentity(100);
        self::assertNotEmpty($user);
    }

    public function testFindIdentityByToken()
    {
        /** @var UserProvider $identityClass */
        $identityClass = Yii::$app->user->identityClass;
        $user = $identityClass::findIdentityByAccessToken('100-token');
        self::assertNotEmpty($user);
        self::assertTrue($user->validateAuthKey($user->getAuthKey()));
    }


}