<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*Authentication Routes Registration*/
Route::auth();

Route::get('/', function () {
	return redirect('login');
});



Route::group(['middleware' => ['auth']], function () {

	Route::resource('reports', 'ReportController');
	Route::resource('patients', 'PatientController');
	Route::resource('tests', 'TestController');
	Route::get('/pdf/{reports}','PdfController@exportPDF');
	Route::post('/mail/{reports}','MailController@sendMail');
});


