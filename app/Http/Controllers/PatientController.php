<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests;
use App\Repositories\PatientRepository;
use Bican\Roles\Models\Role;
use Laracasts\Flash\Flash;
use App\User;

class PatientController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    /**
     * The patient list variable.
     */
    protected $patients;

    /*
    *The patient with id in the URL
    */
    protected $patient;

    /**
     * Create a new controller instance.
     *
     * @param  PatientRepository $patients
     * @return void
     */
    public function __construct(PatientRepository $patients)
    {
        $this->middleware('role:operator');

        /*Get patients list*/
        $this->patients = $patients->getPatientsList()->paginate(5);
        
        /*Get id from the url*/
        $id = \Route::current()->getParameter('patients');  

        /*Get the patient associated with id in the url or fail*/
        if(isset($id)) $this->patient  = $patients->findOrFailPatient($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = $this->patients;

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Validate the inputs of the patient*/
        $this->validate($request, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
            ]);

        $user= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'password' => bcrypt($request['password']),
            ]);

        /*get patientRole object*/
        $patientRole = Role::firstOrNew(['slug' => 'patient']);

        /*Attach the patient role to the user*/
        $user->attachRole($patientRole);

        Flash::success('New Patient user has been created successfully');

        return redirect('/patients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = $this->patient;

        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = $this->patient;

       /*check if the operator user can update the given patient*/
       //$this->authorize('updateOrDelete', $patient);

       return view('patients.edit',compact('patient'));
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
        $patient = $this->patient;

        /*Validate the inputs of the patient*/
        $this->validate($request, [
            'name' => 'required|max:255|unique:users,name,'.$id,
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'mobile' => 'required|numeric',
            ]);

        $input = $request->all();

        $patient->fill($input)->save();

        Flash::info('Patient user has been updated successfully');

        return redirect('/patients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = $this->patient;

        $patient->delete();

        Flash::error('Patient user has been deleted successfully');

        return redirect('/patients');
    }

}
