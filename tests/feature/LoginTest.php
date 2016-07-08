<?php

namespace Qafoo;

class LoginTest extends FeatureTest
{
    public function testLogInWithWrongPassword()
    {
        $page = (new Page\Login($this->session))->visit(Page\Login::PATH);

        $page->setUser(getenv('USER'));
        $page->setPassword('wrongPassword');
        $newPage = $page->login();

        $this->assertInstanceOf(Page\Login::class, $newPage);
    }

    public function testSuccessfulLogIn()
    {
        $page = (new Page\Login($this->session))->visit(Page\Login::PATH);

        $page->setUser(getenv('USER'));
        $page->setPassword(getenv('PASSWORD'));
        $newPage = $page->login();

        $this->assertInstanceOf(Page\Dashboard::class, $newPage);
    }
}
