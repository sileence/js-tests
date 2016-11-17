<?php

class SeleniumTestCase extends PHPUnit_Extensions_Selenium2TestCase
{
    protected $baseUrl = 'http://js-tests.app';

    protected $browser = 'firefox';

    public function setUp()
    {
        $this->setBrowser($this->browser);
        $this->setBrowserUrl($this->baseUrl);
    }

    public function visit($url)
    {
        $this->url($url);

        return $this;
    }

    public function see($html)
    {
        $this->assertContains(
            $html, $this->byTag('body')->text()
        );

        return $this;
    }
}
