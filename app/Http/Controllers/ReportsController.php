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
      return view('reports.home')->with([
        'projects' => Projects::orderBy('name')->pluck('name', 'id')
      ]);
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
    $input_report = storage_path().'/app/reports/carnet3.jasper';
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
    if ($request->has('ee_group_id')) {

      $inputReport = storage_path()
        .'/app/reports/team_equipments_by_group.jasper';
      $output = public_path().'/reports/team_equipments_by_group';

      $report = $this->jasper->process (
        $inputReport,
        $output,
        ['pdf'],
        ['group_id' => $request->ee_group_id],
        config('database.connections.mysql')
      )->execute();

      return \Response::download($output.'.pdf');
    }
  }

  /**
   * Print employees by projects
   */
  public function employeesByProject(Request $request) {
    if ($request->has('epd_project_id')) {
      $input_report = storage_path()
        .'/app/reports/active_employees_by_project.jasper';
      $output = public_path().'/reports/active_employees_by_project';

      $report = $this->jasper->process(
        $input_report,
        $output,
        ['pdf'],
        ['project_id' => $request->epd_project_id],
        config('database.connections.mysql')
      )->execute();

      return \Response::download($output.'.pdf');
    } else {
      \Notify::warning('Parametro faltante', 'Advertencia');
      return redirect()->back();
    }
  }

  /**
   * Print employees by groups
   */
  public function employeesByGroup(Request $request) {
    if ($request->has('group_id')) {
      $input_report = storage_path()
        .'/app/reports/active_employees_by_groups.jasper';
      $output = public_path().'/reports/active_employees_by_group';

      $report = $this->jasper->process(
        $input_report,
        $output,
        ['pdf'],
        ['group_id' => $request->group_id],
        config('database.connections.mysql')
      )->execute();

      return \Response::download($output.'.pdf');
    } else {
      \Notify::warning('Parametro faltante', 'Advertencia');
      return redirect()->back();
    }
  }

  /**
   * Print down employees
   */
  public function employeesDown() {
    $input_report = storage_path()
      .'/app/reports/down_employees.jasper';
    $output = public_path().'/reports/down_employees';

    $report = $this->jasper->process(
      $input_report,
      $output,
      ['pdf'],
      null,
      config('database.connections.mysql')
    )->execute();

    return \Response::download($output.'.pdf');
  }

  /**
   * Print employees' licenses state
   */
  public function licensesState() {
    $input_report = storage_path()
      .'/app/reports/drive_licenses_status.jasper';
    $output = public_path().'/reports/drive_licenses_status';

    $report = $this->jasper->process(
      $input_report,
      $output,
      ['pdf'],
      null,
      config('database.connections.mysql')
    )->execute();

    return \Response::download($output.'.pdf');
  }
}
