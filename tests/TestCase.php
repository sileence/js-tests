<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://js-tests.app';

    /**
     * The default browser to use with the Selenium tests.
     *
     * @var string
     */
    protected $defaultBrowser = 'firefox';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function visitInBrowser($url, $browser = null, array $otherParameters = [])
    {
        $session = new \App\Selenium\Session(
            $this->baseUrl,
            $browser ?: $this->defaultBrowser,
            $otherParameters
        );

        return $session->visit($url);
    }
}
