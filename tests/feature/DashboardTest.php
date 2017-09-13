<?php

namespace Qafoo;

class DashboardTest extends FeatureTest
{
    use Helper\User;

    public function testRedirectUnauthorized()
    {
        $page = (new Page\Dashboard($this->session))->visit(Page\Dashboard::PATH);

        $this->assertInstanceOf(Page\Login::class, $page);
    }

    public function testHasDemoOrganization()
    {
        $this->logIn();

        $page = (new Page\Dashboard($this->session))->visit(Page\Dashboard::PATH);

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
        $this->assertCount(5, $organization->getApplications());
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
