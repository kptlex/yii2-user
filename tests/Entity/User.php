<?php

declare(strict_types=1);

namespace Lex\Yii2\User\Tests\Entity;

use Lex\Yii2\User\Entity\UserInterface;

final class User implements UserInterface
{
    private $id;

    private $authKey;

    private $username;

    private $password;

    private $accessToken;

    public function __construct($id, $authKey, $username, $password, $accessToken)
    {
        $this->id = $id;
        $this->authKey = $authKey;
        $this->username = $username;
        $this->password = $password;
        $this->accessToken = $accessToken;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


}