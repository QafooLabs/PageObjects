<?php

namespace Qafoo;

class DashboardTest extends FeatureTest
{
    use Helper\User;

    public function testHasDemoOrganization()
    {
        $this->logIn();

        $page = new Page\Dashboard($this->session);
        $page->visit();

        $organizations = $page->getOrganizations();
        $this->assertArrayHasKey('demo', $organizations);
        return $organizations['demo'];
    }

    /**
     * @depends testHasDemoOrganization
     */
    public function testMonthlyRequestLimitReached(Page\Dashboard\Organization $organization)
    {
        $this->assertFalse($organization->getMonthlyRequestLimitReached());
    }

    /**
     * @depends testHasDemoOrganization
     */
    public function testHasDemoApplications(Page\Dashboard\Organization $organization)
    {
        $this->assertCount(3, $organization->getApplications());
    }

    /**
     * @depends testHasDemoOrganization
     */
    public function testDemoApplicationData(Page\Dashboard\Organization $organization)
    {
        $application = $organization->getApplications()['wordpress_demo'];

        $this->assertGreaterThan(0, $application->getResponseTime());
        $this->assertGreaterThan(0, $application->getRequestsPerMinute());
    }
}
