Installation
------------

1. Use composer.

```
composer require kptlex/yii2-user
```

2. Set identity class to configs(for yii2):

```
<?php

declare(strict_types=1);

use App\Repository\UserRepository;
use Lex\Yii2\User\SecurityInterface;
use Lex\Yii2\User\Repository\UserRepositoryInterface;
use Lex\Yii2\User\Provider\SecurityService;
use Lex\Yii2\User\Provider\UserProvider;

return [
    'components' => [
        'user' => [
            'identityClass' => UserProvider::class
        ]
    ]
];
```

3. Set security service and user repository classes:

```php
use Lex\Yii2\User\SecurityInterface;
use Lex\Yii2\User\Repository\UserRepositoryInterface;
use Yiisoft\Auth\IdentityWithTokenRepositoryInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Lex\Yii2\User\CurrentUser;

return [
    'container' => [
        'definitions' => [
            SecurityInterface::class => [
                'class' => CurrentUser::class
            ],
            IdentityWithTokenRepositoryInterface::class => [
                'class' => UserRepository::class
            ],
            IdentityRepositoryInterface::class => [
                'class' => UserRepository::class
            ]
        ]
    ]
];
```

4. Warning: User must be implemented with `Lex\Yii2\User\
5. IdentityWithTokenInterface`.