<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class ReportControllerTest extends TestCase
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
     * Test report index page
     *
     * @return void
     */
      public function testReportsIndex()
	{
	    $response = $this->call('get', 'reports');
		 $this->assertViewHas('reports');
	 
	    
	    $reports = $response->original->getData()['reports'];
	 
	    $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $reports);
	    $this->assertResponseOk();
	}


    /**
     * Test report controller should save report
     *
     * @return void
     */
    function testReportControllerShouldSaveReport()
    {
    	$this->withoutMiddleware();

    	$response = $this->call('post', 'reports');

    	$this->assertEquals(302, $response->status());
    }

      
}
