<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;	

class PatientControllerTest extends TestCase
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
     * Test patient index page
     *
     * @return void
     */
	 public function testPatientsIndex()
	{
	    $response = $this->call('get', 'patients');
	     
	    $patients = $response->original->getData()['patients'];
	 
	    $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $patients);
	 
	    $this->assertResponseOk();
	}


	 /**
     * Test patient controller should save patient
     *
     * @return void
     */
    function testPatientControllerShouldSavePatient()
    {
    	$this->withoutMiddleware();

    	$response = $this->call('post', 'patients');

    	$this->assertEquals(302, $response->status());
    }






}
