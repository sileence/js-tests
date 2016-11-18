<?php

namespace App\Selenium;

use PHPUnit_Framework_Assert as Assertion;
use PHPUnit_Extensions_Selenium2TestCase_URL as Url;
use PHPUnit_Extensions_Selenium2TestCase_NoSeleniumException as NoSeleniumException;
use PHPUnit_Extensions_Selenium2TestCase_SessionStrategy_Isolated as IsolatedStrategy;

class Session
{
    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase_Driver
     */
    protected $driver;

    protected $parameters = [];

    public function __construct($url, $browser, array $parameters = [])
    {
        $parameters = array_merge([
            'host' => 'localhost',
            'port' => 4444,
            'browserName' => $browser,
            'desiredCapabilities' => [],
            'seleniumServerRequestsTimeout' => 60,
            'browserUrl' => new Url($url),
        ], $parameters);

        try {
            return $this->driver = $this->getStrategy()->session($parameters);
        } catch (NoSeleniumException $e) {
            throw new InvalidServer(sprintf(
                "The Selenium Server is not active on host [%s] at port [%s].",
                $parameters['host'], $parameters['port']
            ));
        }
    }

    public function visit($url)
    {
        $this->driver->url($url);

        return $this;
    }

    public function see($html)
    {
        Assertion::assertContains(
            $html, $this->driver->byTag('body')->text()
        );

        return $this;
    }

    public function dontSee($html)
    {
        Assertion::assertNotContains(
            $html, $this->driver->byTag('body')->text()
        );

        return $this;
    }

    protected function getStrategy()
    {
        return new IsolatedStrategy();
    }
}
