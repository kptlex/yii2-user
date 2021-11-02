<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Security;

use PHPUnit\Framework\TestCase;
use Lex\Yii2\User\Tests\Helper\RequestHelper;

final class ViewInjectionTest extends TestCase
{
    public function testViewInjection()
    {
        $result = RequestHelper::sendRequest('test/view');
        self::assertSame('guest', $result);
    }
}