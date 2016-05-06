<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class Guest extends TestCase
{


	/**
     * Test Index Page Redirects To login.
     *
     * @return void
     */
    public function testIndexRedirectsToLogin()
    {

        $this->visit('/')
        ->seePageIs('/login');
    }

    /**
     * Test Register Redirects To login.
     *
     * @return void
     */
    public function testRegisterRedirectsToLogin()
    {

        $this->visit('/register')
        ->seePageIs('/login');
    }



    /**
     * Test correct User login.
     *
     * @return void
     */
    public function testCorrectUserLogin()
    {
        $this->visit('/login')
        ->type('Ahmed', 'name')
        ->type('123456', 'password')
        ->press('Login')
        ->seePageIs('/reports');
    }

    /**
     * Test fake User login.
     *
     * @return void
     */
    public function testFakeUserLogin()
    {
        $this->visit('/login')
        ->type('fakename', 'name')
        ->type('fakepassword', 'password')
        ->press('Login')
        ->see('These credentials do not match our records.')
        ->seePageIs('/login');
    }



}
