<?php

declare(strict_types=1);

use yii\web\Application;

define('YII_DEBUG', false);
define('YII_ENV_TEST', true);
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ .'/../vendor/autoload.php';

$config = require __DIR__ . DIRECTORY_SEPARATOR . 'config.php';

try {
    (new Application($config));
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
