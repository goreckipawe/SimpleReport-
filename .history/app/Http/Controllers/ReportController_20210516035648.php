<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facade as Debugbar;
use App\Services\ReportService;

class ReportController extends Controller
{
    private $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function report()
    {
        $data = array("report" => array(), "report_simplifies_version" => array());

        try {
            $report = $this->reportService->report(); //Zadanie 2 – PHP
            $data["report"] = $report["data"];
            $report_simplifies_version = $this->reportService->report_simplifies_version();//Zadanie 1 – SQL
            $data["report_simplifies_version"] = $report_simplifies_version["data"];

            Debugbar::info($data);

            return view('report', ["data" => $data]);
        } catch (\Exception $e){
            return view('report', ["data" => $data]);
        }
    }


}
