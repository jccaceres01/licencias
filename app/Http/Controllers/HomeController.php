<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\EmployeesByProjectChart;
use App\Models\Employees;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /**
       * Drive License expired and next to expired data
       */
      $today = new \DateTime('today');
      $tomorrow = new \DateTime('tomorrow');
      $threeMonths = new \DateTime('+3 months');

      $endedLicensesCount = Employees::activeAndStandBy()
        ->where('drive_license_end', '<', $today->format('y-m-d'))->count(); // get expired drive license

      $nextToExpireLicenseCount = Employees::activeAndStandBy()
        ->whereBetween('drive_license_end', [
          $tomorrow->format('y-m-d'),
          $threeMonths->format('y-m-d')
        ])
      ->count();

      /**
       * Total employes chart
       */
      $employeesByProjectChart = new EmployeesByProjectChart;
      $employeesByProjectDS = Employees::select(\DB::raw('count(employees.id) as Total'),
        'projects.name as Proyecto')
        ->join('projects', 'projects.id', '=', 'employees.project_id')
        ->groupBy('projects.name')->get();

      $employeesByProjectChart->labels($employeesByProjectDS->pluck('Proyecto'));
      $employeesByProjectChart->dataset('Total empleados por proyecto', 'pie',
        $employeesByProjectDS->pluck('Total'));

      /**
       * Return data
       */
      return view('home')->with([
        'employeesByProjectChart' => $employeesByProjectChart,
        'endedLicensesCount' => $endedLicensesCount,
        'nextToExpireLicenseCount' => $nextToExpireLicenseCount
      ]);
    }
}
