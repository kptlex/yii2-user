<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Helper;

use Lex\Yii2\Web\WebRequestFactory;
use Yii;

final class RequestHelper
{
    public static function sendRequest(string $url)
    {
        Yii::$app->request->setUrl($url);
        $webRequestFactory = Yii::$container->get(WebRequestFactory::class);
        $webRequestFactory->bootstrap(Yii::$app);
        return Yii::$app->runAction($url);
    }
}