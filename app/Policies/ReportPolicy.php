<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Report;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     /**
     * Determine if the given patient user can show the given report.
     *
     * @param  User  $user
     * @param  Report  $report
     * @return bool
     */
    public function show(User $user, Report $report)
    {
        return $user->id === $report->patient_id;
    }


}
