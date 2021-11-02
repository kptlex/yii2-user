<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Security;

use PHPUnit\Framework\TestCase;
use Lex\Yii2\User\SecurityInterface;
use Lex\Yii2\User\Tests\Helper\RequestHelper;
use Yii;
use yii\base\ExitException;
use yii\web\Response;

final class AuthTest extends TestCase
{
    public function testAuthSuccess()
    {
        $response = RequestHelper::sendRequest('test/auth-success');
        self::assertSame('success', $response);
        $security = Yii::$container->get(SecurityInterface::class);
        self::assertNotTrue($security->isGuest());
    }

    public function testLogout()
    {
        $this->testAuthSuccess();
        $security = Yii::$container->get(SecurityInterface::class);
        $security->logout();
        self::assertTrue($security->isGuest());
    }

    public function testAuthSuccessWithMethod()
    {
        $this->expectException(ExitException::class);
        RequestHelper::sendRequest('test/auth-success-with-method');
    }

    public function testAuthFail()
    {
        $response = RequestHelper::sendRequest('test/auth-fail');
        self::assertSame('failure', $response);
        self::assertNull(Yii::$app->user->getId());
    }

    public function testAuthFailWithMethod()
    {
        $this->expectException(ExitException::class);
        /** @var Response $response */
        RequestHelper::sendRequest('test/auth-fail-with-method');
    }
}