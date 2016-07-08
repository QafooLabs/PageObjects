<?php

namespace Qafoo;

use Behat\Mink\Session;

abstract class Page
{
    protected $session;

    protected $document;

    private $pageRegistry = array(
        '/login' => Page\Login::class,
        '/dashboard' => Page\Dashboard::class,
    );

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    protected function visitPath($path)
    {
        if (!$this->session) {
            $this->start();
        }

        $domain = getenv('SERVER') ?: 'http://localhost:8888';
        $this->session->visit($domain . $path);
        return $this->document = $this->session->getPage();
    }

    protected function find($cssSelector)
    {
        $element = $this->document->find('css', $cssSelector);
        \PHPUnit_FrameWork_Assert::assertNotNull($element, "Element $cssSelector not found");
        return $element;
    }

    protected function createFromDocument()
    {
        $this->document = $this->session->getPage();
        $path = parse_url($this->session->getCurrentUrl(), PHP_URL_PATH);
        \PHPUnit_FrameWork_Assert::assertArrayHasKey($path, $this->pageRegistry);
        $pageClass = $this->pageRegistry[$path];
        return new $pageClass($this->session);
    }

    abstract public function visit();
}
