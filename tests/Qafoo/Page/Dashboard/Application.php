<?php

namespace Qafoo\Page\Dashboard;

class Application
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getResponseTime()
    {
        return $this->data->responseTime;
    }

    public function getRequestsPerMinute()
    {
        return $this->data->requests;
    }
}
