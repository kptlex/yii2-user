# Using

* The user is controlled using `Lex\Yii2\User\SecurityInterface`.

    ```php
    namespace App\Controller\Api;
    
    use Lex\Yii2\User\SecurityInterface;
    use yii\rest\Controller;
    use yii\web\Response;
    
    final class TestController extends Controller {
        private SecurityInterface $security;
    
        public function __construct($id, $module, SecurityInterface $security, $config = []) {
            $this->security = $security;
            parent::__construct($id,$module,$config);
        }
        
        /**
        * Get current user.
        * @return Response
        */
        public function actionCurrentUser(): Response {
            return $this->asJson(['id' => $this->security->getUser()->getId(), 'isGuest'=> $this->security->isGuest()]);
        }
        
        /**
        * Check user permission.
        * @return Response
        */
        public function actionCheckPermission(string $permission): Response {
            return $this->asJson($this->security->can($permission));
        }
    }
    
    ```

* Also we can use `Lex\Yii2\User\Middleware\AuthenticationMiddleware` which will use
  `Yiisoft\Auth\AuthenticationMethodInterface`.