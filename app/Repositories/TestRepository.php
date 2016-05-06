<?php

namespace App\Repositories;

use App\Report;
use App\Test;

class TestRepository
{
    /**
     * Get all of the tests for a given report.
     *
     * @param  Report  $report
     * @return Collection
     */
    public function forReport(Report $report)
    {
        return Test::where('report_id', $report->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}