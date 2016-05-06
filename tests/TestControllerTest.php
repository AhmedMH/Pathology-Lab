<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestControllerTest extends TestCase
{
    /**
     * Test Test controller should save test
     *
     * @return void
     */
    function testTestControllerShouldSaveTest()
    {
    	$this->withoutMiddleware();

    	$response = $this->call('post', 'tests');

    	$this->assertEquals(302, $response->status());
    }
}
