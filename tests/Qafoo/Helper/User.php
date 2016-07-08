<?php

namespace Qafoo\Helper;

use Qafoo\Page;

trait User
{
    public function logIn()
    {
        $page = new Page\Login($this->session);
        $page->visit();

        $page->setUser(getenv('USER'));
        $page->setPassword(getenv('PASSWORD'));
        $newPage = $page->login();

        $this->assertInstanceOf(Page\Dashboard::class, $newPage);
    }
}
