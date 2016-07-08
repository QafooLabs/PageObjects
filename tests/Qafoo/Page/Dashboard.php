<?php

namespace Qafoo\Page;

use Qafoo\Page;

class Dashboard extends Page
{
    const PATH = '/dashboard';

    public function getOrganizations()
    {
        $dataElement = $this->find('[data-dashboard]');
        $dataUrl = $dataElement->getAttribute('data-dashboard');

        $data = json_decode($this->visitPath($dataUrl)->getContent());
        \PHPUnit_FrameWork_Assert::assertNotNull($data, "Failed to parse JSON response");

        $organizations = array();
        foreach ($data->organizations as $organization) {
            $organizations[$organization->name] = new Dashboard\Organization($organization, $data->applications);
        }

        return $organizations;
    }
}
