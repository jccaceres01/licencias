<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use JasperPHP\JasperPHP;
use App\Projects;

class ReportsController extends Controller
{
  /**
   *
   */
  public function __construct() {
    $this->jasper = new JasperPHP;
  }
  /**
   * Report home
   */
  public function home() {
    if (\Auth::user()->can('view reports')) {
      return view('reports.home')->with(
        'projects', Projects::orderBy('name')->pluck('name', 'id')
      );
    } else {
      \Notify::warning('No tiene privilegios para ver o imprimir reportes',
        'Información');
      return redirect()->back();
    }
  }
  /**
   * Print employee's license carnet
   */
  public function employeeLicence($employee_id) {

    $emp = Employees::find($employee_id);
    $input_report = storage_path().'/app/reports/safety2_carnet3.jasper';
    $output = public_path().'/reports/carnet';

    $report = $this->jasper->process(
      $input_report,
      $output,
      ['pdf'],
      ['p_id' => $emp->id],
      config('database.connections.mysql')
    )->execute();

    return \Response::download($output.'.pdf');
  }

  /**
   * Employee's equipments report
   */
  public function employeesEquipments(Request $request) {
    if ($request->has('project_id')) {

      $inputReport = storage_path().'/app/reports/safety2_team_equipment.jasper';
      $output = public_path().'/reports/team_equipments';

      $report = $this->jasper->process(
        $inputReport,
        $output,
        ['pdf'],
        ['project_id' => $request->project_id],
        config('database.connections.mysql')
      )->execute();

      return \Response::download($output.'.pdf');
    }
  }
}
