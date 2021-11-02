# User view injection

For injection of user to view you must use View component from kptlex/yii2-web package.

* Configuration

```php

declare(strict_types=1);

use Lex\Yii2\User\UserViewInjection;
use Lex\Yii2\Web\View;
use Lex\Yii2\Web\WebRequestFactory;

return [
    'bootstrap' => [WebRequestFactory::class],
    'components' => [
        'view' => [
            'class' => View::class,
            'injections' => [
                UserViewInjection::class
            ]
        ]
    ]
];
```

* After that, the variables `$user` and` $security` will be available in your views.

Example of heafer for your view files.

```php
declare(strict_types=1);

use Yiisoft\Auth\IdentityInterface;
use Lex\Yii2\User\SecurityInterface;
use yii\web\View;

/**
 * @var IdentityInterface $user
 * @var SecurityInterface $security
 * @var View $this
 */
```