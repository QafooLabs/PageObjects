<?php

namespace Qafoo\Page\Dashboard;

class Organization
{
    private $data;
    private $applicationData;

    public function __construct($data, $applicationData)
    {
        $this->data = $data;
        $this->applicationData = $applicationData;
    }

    public function getMonthlyRequestLimitReached()
    {
        return $this->data->monthlyRequestLimitReached;
    }

    public function getApplications()
    {
        $applications = array();
        foreach ($this->data->applications as $application) {
            $applications[$application->name] = new Application(
                $this->applicationData->{$application->id}
            );
        }

        return $applications;
    }
}
