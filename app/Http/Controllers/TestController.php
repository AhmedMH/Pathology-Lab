<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Test;

class TestController extends Controller
{

    /*
    *The test with id in the URL
    */
    protected $test;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:operator');

        /*Get id from the url*/
        $id = \Route::current()->getParameter('tests');  

        /*Get the report associated with id in the url or fail*/
        if(isset($id)) $this->test  = Test::findOrFail($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Validate the inputs of the test*/
        $this->validate($request, [
            'name' => 'required|max:255',
            'result' => 'required|max:255',
            ]);

        /*Create the report and assign it to the operator and the patient*/
        Test::create([
            'name' => $request->name,
            'result' => $request->result,
            'report_id' => $request->report_id
            ]);

        return redirect('/reports/'.$request->report_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $test = $this->test;

       return view('tests.edit',compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $test = $this->test;

        /*Validate the inputs of the test*/
        $this->validate($request, [
            'name' => 'required|max:255',
            'result' => 'required|max:255',
            ]);

        $input = $request->all();

        $test->fill($input)->save();

        Flash::info('Test has been updated successfully');


        return redirect('/reports/'.$test->report_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = $this->test;

        $test->delete();

        Flash::error('Test has been deleted successfully');

        return redirect('/reports/'.$test->report_id);
    }
}
