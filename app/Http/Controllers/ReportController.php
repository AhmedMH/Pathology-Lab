<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ReportRepository;
use App\Repositories\PatientRepository;
use Laracasts\Flash\Flash;
use App\User;
use App\Report;

class ReportController extends Controller
{
    /**
     * The report repository instance.
     *
     * @var ReportRepository
     */
    protected $reports;

    /*
    *The report with id in the URL
    */
    protected $report;

    /**
     * The patient list variable.
     */
    protected $patients;

    /**
     * Create a new controller instance.
     *
     * @param  ReportRepository  $reports
     * @param  PatientRepository $patients
     * @return void
     */
    public function __construct(ReportRepository $reports, PatientRepository $patients)
    {
        /*protected operator's routes using middle ware of role:operator*/
        $this->middleware('role:operator',['except' => ['index','show','exportPDF','sendMail']]);
        
        /*protected patient's routes using middle ware of role:operator*/
        $this->middleware('role:patient', ['only' => ['exportPDF','sendMail']]);  
        
        $this->reports = $reports;

        /*Get id from the url*/
        $id = \Route::current()->getParameter('reports');  

        /*Get the report associated with id in the url or fail*/
        if(isset($id)) $this->report  = Report::findOrFail($id);


        /*Get patients list*/
        $this->patients = $patients->getPatientsList()->lists('name','id');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->user()->hasRole('patient'))
        {
          /*get all reports for a the current user patient*/
          $reports = $this->reports->forPatient($request->user());
        }
        else
        {
        /*get all reports*/
        $reports = Report::paginate(5);
        }

        /*Return the index view of reports - it has a list of all reports for the current user opertator*/
        return view('reports.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = $this->patients;

        return view('reports.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Validate the inputs of the report*/
        $this->validate($request, [
            'name' => 'required|max:255',
            'patient_id' => 'required',
            ]);

        /*Create the report and assign it to the operator and the patient*/
        $report = Report::create([
            'name' => $request->name,
            'operator_id' => $request->user()->id,
            'patient_id' => $request->patient_id
            ]);

        Flash::success('New Report has been created successfully');

        return redirect('/reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        /*check if the patient user can show the given report*/
         if(\Request::user()->hasRole('patient'))  $this->authorize('show', $this->report);

        return view('reports.show',$this->reports->getReportContent($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = $this->report;

        $patients = $this->patients;

        return view('reports.edit',compact('report','patients'));
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
        $report = $this->report;

        /*Validate the inputs of the report*/
        $this->validate($request, [
            'name' => 'required|max:255',
            'patient_id' => 'required',
            ]);

        $input = $request->all();

        $report->fill($input)->save();

        Flash::info('Report has been updated successfully');

        return redirect('/reports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $report = $this->report;

        $report->delete();

        Flash::error('Report has been deleted successfully');

        return redirect('/reports');
    }

}

