<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeleniumTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visitInBrowser('/')
            ->see('Styde');
    }

    public function testTwoRequestsInASingleMethod()
    {
        $session1 = $this->visitInBrowser('laravel');

        $session2 = $this->visitInBrowser('php');

        $session1->see('Laravel')
            ->dontSee('Taylor');

        $session2->see('PHP')
            ->dontSee('Laravel');
    }
}
