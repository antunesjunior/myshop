<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class ReportController extends Controller
{
    public function caixa()
    {
        $years = range(2019, (date("Y")));
        $months = DateHelper::getMonths();
        $yearLimit = array_search(date('Y'), $years);
       // $monthsList = array_slice($months, 0, (date('m') - 1));
        return view('admin.reports.caixa', [
            'years' => $years,
            'limit' => $yearLimit,
            'months' => $months
        ]);
    }
}
