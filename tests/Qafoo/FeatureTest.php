<?php

namespace Qafoo;

use Behat\Mink\Driver;
use Behat\Mink\Session;

abstract class FeatureTest extends IntegrationTest
{
    protected $session;

    public function setUp()
    {
        switch (strtolower(getenv('DRIVER'))) {
            case 'sahi':
                $browser = getenv('BROWSER') ?: 'firefox';
                $driver = new Driver\SahiDriver($browser);
                break;

            case 'goutte':
            default:
                $driver = new Driver\GoutteDriver();
        }

        $this->session = new Session($driver);
        $this->session->start();
    }

    public function stop()
    {
        if ($this->session) {
            $this->session->stop();
            $this->session = null;
        }
    }

    public function tearDown()
    {
        if (!$this->hasFailed()) {
            $this->stop();
        }
    }
}
