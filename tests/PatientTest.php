<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class PatientTest extends TestCase
{
    /**
     * Login the patient user
     *
     * @return void
     */
    public function setUp ()
    {
    	parent::setUp();

        $user = User::whereHas(
            'roles', function($q){
                $q->where('slug', 'patient');
            }
            )->first();
        $this->actingAs($user);
	}

	/**
     * Test Index Page Redirects To reports when user is patient.
     *
     * @return void
     */
    public function testIndexRedirectsToReportsForPatient()
    {

        $this->visit('/')
             ->seePageIs('/reports');
    }

    /**
     * Test Register Redirects To reports when user is patient.
     *
     * @return void
     */
    public function testRegisterRedirectsToReportsForPatient()
    {

        $this->visit('/register')
             ->seePageIs('/reports');
    }

    /**
     * Test patient user can not acces patients page.
     *
     * @return void
     */
    public function testPatientCannotAccessPatientsPage()
    {

        $response = $this->call('GET', '/patients');

	    $this->assertEquals(403, $response->status());
    }

     /**
     * Test patient user cant not create a report.
     *
     * @return void
     */
    public function testPatientCannotCreateReport()
    {

        $response = $this->call('GET', '/reports/create');

	    $this->assertEquals(403, $response->status());
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
}
