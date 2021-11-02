<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Controller;

use Psr\Http\Message\ResponseFactoryInterface;
use Lex\Yii2\User\Middleware\AuthenticationMiddleware;
use Lex\Yii2\User\SecurityInterface;
use Lex\Yii2\User\Tests\AuthenticationMethod\TestFailedMethod;
use Lex\Yii2\User\Tests\AuthenticationMethod\TestSuccessMethod;
use Lex\Yii2\User\Tests\Repository\UserRepository;
use yii\web\Controller;

final class TestController extends Controller
{
    private SecurityInterface $security;
    private ResponseFactoryInterface $responseFactory;
    private UserRepository $userRepository;

    public function __construct(
        $id,
        $module,
        SecurityInterface $security,
        UserRepository $userRepository,
        ResponseFactoryInterface $responseFactory,
        $config = []
    ) {
        $this->security = $security;
        $this->userRepository = $userRepository;
        $this->responseFactory = $responseFactory;
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => MiddlewareDispatcherBehavior::class,
                'actions' => ['auth-fail'],
                'middlewares' => [
                    new AuthenticationMiddleware($this->security, $this->responseFactory, new TestFailedMethod(false))
                ]
            ],
            [
                'class' => MiddlewareDispatcherBehavior::class,
                'actions' => ['auth-fail-with-method'],
                'middlewares' => [
                    new AuthenticationMiddleware($this->security, $this->responseFactory, new TestFailedMethod(true))
                ]
            ],
            [
                'class' => MiddlewareDispatcherBehavior::class,
                'actions' => ['auth-success'],
                'middlewares' => [
                    new AuthenticationMiddleware(
                        $this->security,
                        $this->responseFactory,
                        new TestSuccessMethod($this->userRepository, false)
                    )
                ]
            ],
            [
                'class' => MiddlewareDispatcherBehavior::class,
                'actions' => ['auth-success-with-method'],
                'middlewares' => [
                    new AuthenticationMiddleware(
                        $this->security,
                        $this->responseFactory,
                        new TestSuccessMethod($this->userRepository, true)
                    )
                ]
            ]
        ];
    }

    public function actionView(): string
    {
        return $this->render('view');
    }

    public function actionAuthFail(): string
    {
        return 'failure';
    }

    public function actionAuthFailWithMethod(): string
    {
        return $this->actionAuthFail();
    }

    public function actionAuthSuccess(): string
    {
        return 'success';
    }

    public function actionAuthSuccessWithMethod(): string
    {
        return $this->actionAuthSuccess();
    }
}