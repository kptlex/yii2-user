<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Security;

use PHPUnit\Framework\TestCase;
use Lex\Yii2\User\SecurityInterface;
use Yii;

final class GuestTest extends TestCase
{
    public function testGuest()
    {
        $security = Yii::$container->get(SecurityInterface::class);
        self::assertSame(true, $security->isGuest());
        self::assertSame(null, $security->getUser()->getId());
        self::assertSame(null, $security->getUser()->getAuthKey());
    }
}