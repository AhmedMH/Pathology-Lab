<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReportRepository;

use App\Http\Requests;
use App\Report;

class PdfController extends Controller
{
	/**
     * The report repository instance.
     *
     * @var ReportRepository
     */
    protected $reports;

     /**
     * Create a new controller instance.
     *
     * @param  ReportRepository  $reports
     * @param  PatientRepository $patients
     * @return void
     */
    public function __construct(ReportRepository $reports)
    {   
        $this->reports = $reports;
    }
   
   /**
     * Export the pdf file of the report
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return pdf downloadable file
     */
    public function exportPDF(Request $request, $id)
    {
    	 $report = Report::findOrFail($id);

    	/*check if the patient user can show the given report*/
         if(\Request::user()->hasRole('patient'))  $this->authorize('show', $report);

        $reportData = $this->reports->getReportContent($id);
        $pdf = \PDF::loadView('pdf.report', $reportData );
        return $pdf->download('Report - '.$reportData['report']->name.'.pdf');
    }
}
