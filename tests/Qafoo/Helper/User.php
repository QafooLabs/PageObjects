<?php

namespace Qafoo\Helper;

trait User
{
    public function logIn()
    {
        $page = new Page\Login($this->session);
        $page->visit();

        $page->setUser(getenv('USER'));
        $page->setPassword(getenv('PASSWORD'));
        $newPage = $page->login();

        $this->assertInstanceOf($newPage, Page\Dashboard::class);
    }
}
