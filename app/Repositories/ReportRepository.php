<?php

namespace App\Repositories;

use App\Http\Requests;
use App\User;
use App\Report;
use App\Repositories\TestRepository;
use App\Http\Controllers\Controller;


class ReportRepository
{


    /**
     * The tests of a given report.
     */
    protected $tests;

     /**
     * Create a new controller instance.
     *
     * @param  ReportRepository  $reports
     * @param  PatientRepository $patients
     * @return void
     */
    public function __construct(TestRepository $tests)
    {
        $this->tests = $tests;
    }

    /**
     * Get all of the reports for a given patient user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forPatient(User $user)
    {
        return Report::where('patient_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->paginate(5);
    }

    /**
     * Get a specific report content
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */

    public function getReportContent($id)
    {
        /*Get the given report*/
        $report = Report::findOrFail($id);

        $tests= $this->tests->forReport($report);

        return compact('report','tests');
    }

}