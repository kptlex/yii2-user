<?php

declare(strict_types=1);

namespace Lex\Yii2\User;

use Lex\Yii2\Web\ContentParametersInjectionInterface;

final class UserViewInjection implements ContentParametersInjectionInterface
{
    private SecurityInterface $security;

    public function __construct(SecurityInterface $security)
    {
        $this->security = $security;
    }

    public function getContentParameters(): array
    {
        return [
            'security' => $this->security,
            'user' => $this->security->getUser()
        ];
    }
}