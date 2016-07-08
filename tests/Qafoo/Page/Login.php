<?php

namespace Qafoo\Page;

use Qafoo\Page;

class Login extends Page
{
    public function visit()
    {
        $this->visitPath('/login');
    }

    public function setUser($user)
    {
        $this->find('input[name="_username"]')->setValue($user);
    }

    public function setPassword($password)
    {
        $this->find('input[name="_password"]')->setValue($password);
    }

    public function login()
    {
        $this->find('input[name="_submit"]')->press();

        return $this->createFromDocument();
    }
}
