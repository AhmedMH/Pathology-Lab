<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReportRepository;
use Laracasts\Flash\Flash;

use App\Http\Requests;
use App\Report;

class MailController extends Controller
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
     * Send the report as mail attachment
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \PHPMailer $mail
     * @return response
     */
    public function sendMail($id,Request $request, \PHPMailer $mail)
    {

    	$report = Report::find($id);

    	/*check if the patient user can show the given report*/
        if(\Request::user()->hasRole('patient'))  $this->authorize('show', $report);

        $reportData = $this->reports->getReportContent($id);
        $pdf = \PDF::loadView('pdf.report', $reportData )->setPaper('a4', 'landscape')->setWarnings(false)->save(storage_path('Report - '.$reportData['report']->name.'.pdf'));
        

        $mail->isSMTP(); 

        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = true; 
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->Port = 2525;                                    

        $mail->setFrom('enghamed126@gmail.com');
        $mail->addAddress($request->email);     

        $mail->addAttachment(storage_path('Report - '.$reportData['report']->name.'.pdf'), 'Report - '.$reportData['report']->name.'.pdf');    
        $mail->isHTML(true);                                  

        $mail->Subject = 'Report - '.$reportData['report']->name;
        $mail->Body    = 'Kindly find yout attached Report of results';
        if(!$mail->send()) {

            Flash::error('E-mail could not be sent: '.$mail->ErrorInfo);

        } 
        else {

            Flash::success('E-mail has been sent successfully');

        }
        unlink(storage_path('Report - '.$reportData['report']->name.'.pdf'));

        return redirect()->back();
    }
}
