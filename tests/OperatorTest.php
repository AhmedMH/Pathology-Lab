<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class OperatorTest extends TestCase
{
    /**
     * Login the operator user
     *
     * @return void
     */
    public function setUp ()
    {
    	parent::setUp();

        $user = User::whereHas(
            'roles', function($q){
                $q->where('slug', 'operator');
            }
            )->first();
        $this->actingAs($user);
	}


	/**
     * Test Index Page Redirects To reports when user is operator.
     *
     * @return void
     */
    public function testIndexRedirectsToReportsForOperator()
    {

        $this->visit('/')
             ->seePageIs('/reports');
    }

    /**
     * Test Register Redirects To reports when user is operator.
     *
     * @return void
     */
    public function testRegisterRedirectsToReportsForOperator()
    {        

        $this->visit('/register')
             ->seePageIs('/reports');
    }

    /**
     * Test Reports Link lands on the correct page.
     *
     * @return void
     */
    public function testReportsLink()
    {
         $this->visit('/')
         ->click('Reports')
         ->seePageIs('/reports');
    }

     /**
     * Test patients Link lands on the correct page.
     *
     * @return void
     */
    public function testPatientsLink()
    {
         $this->visit('/')
         ->click('Patients')
         ->seePageIs('/patients');
    }



}
