User component
---------------------

[![Latest Stable Version](https://poser.pugx.org/kptlex/yii2-user/v)](//packagist.org/packages/kptlex/yii2-user)
[![Latest Unstable Version](https://poser.pugx.org/kptlex/yii2-user/v/unstable)](//packagist.org/packages/kptlex/yii2-user)
[![Build Status](https://github.com/kptlex/yii2-user/workflows/build/badge.svg)](https://github.com/kptlex/yii2-user/actions)
[![codecov](https://codecov.io/gh/kptlex/yii2-user/branch/main/graph/badge.svg?token=S5C6K9Y760)](https://codecov.io/gh/kptlex/yii2-user)

Services and interfaces for working with users.

* [Installation](docs/install.md)

Using
-----

For control users, we can use `Lex\Yii2\User\SecurityInterface`.

Also we can use authentication with `Lex\Yii2\User\Middleware\AuthenticationMiddleware`. For AuthenticationMiddleware to work, we
need to add own class, that implements
`Lex\Yii2\User\AuthenticationMethod\AuthenticationMethodInterface`.


Requirements
------------

* PHP 7.4 or higher.

