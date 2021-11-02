<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Middleware;

use Lex\Yii2\User\RequestHandler\AuthenticationFailureHandler;
use Lex\Yii2\User\RequestHandler\AuthenticationSuccessHandler;
use Lex\Yii2\User\SecurityInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Auth\AuthenticationMethodInterface;

final class AuthenticationMiddleware implements MiddlewareInterface
{
    private AuthenticationMethodInterface $authenticationMethod;
    private AuthenticationSuccessHandler $authenticationSuccess;
    private AuthenticationFailureHandler $authenticationFailure;
    private SecurityInterface $security;

    public string $method;

    public function __construct(
        AuthenticationMethodInterface $authenticationMethod,
        SecurityInterface             $security,
        ResponseFactoryInterface      $responseFactory,
        ?RequestHandlerInterface      $authenticationFailure = null,
        ?RequestHandlerInterface      $authenticationSuccess = null
    )
    {
        $this->security = $security;
        $this->authenticationMethod = $authenticationMethod;
        $this->authenticationFailure = $authenticationFailure ?: new AuthenticationFailureHandler($responseFactory);
        $this->authenticationSuccess = $authenticationSuccess ?: new AuthenticationSuccessHandler($responseFactory);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $identity = $this->authenticationMethod->authenticate($request);
        $request->withAttribute(self::class, $identity);
        if ($identity && $this->security->login($identity)) {
            $success = $this->authenticationMethod->challenge(
                $this->authenticationSuccess->handle($request)
            );
            if ($success) {
                return $success;
            }
        } else {
            $failure = $this->authenticationMethod->challenge(
                $this->authenticationFailure->handle($request)
            );
            if ($failure) {
                return $failure;
            }
        }
        return $handler->handle($request);
    }
}
