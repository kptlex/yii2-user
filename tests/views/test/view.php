<?php

declare(strict_types=1);

use Lex\Yii2\User\Entity\UserInterface;

/**
 * @var UserInterface $user
 */
echo $user->getId() ?: 'guest';