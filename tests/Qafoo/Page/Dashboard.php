<?php

namespace Qafoo\Page;

use Qafoo\Page;

class Dashboard extends Page
{
    public function visit()
    {
        $this->visitPath('/dashboard');
    }
}
