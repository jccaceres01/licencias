<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class ReportsController extends Controller
{
  /**
   * Constructor
   */
  public function __construct() {
    $this->middleware('auth');
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
   * Report Preview
   */
  public function preview(Request $request) {
    $report_url = config('reports.server').'/flow.html?_flowId=viewReportFlow&j_username='. config('reports.username') .'&j_password='. config('reports.password'). '&reportUnit='. $request->report .'&decorate=no';
    $params = $request->params;

    if (!empty($params)) {
      foreach($params as $key => $value) {
        $report_url .= '&'.$key.'='.$value;
      }
    }

    return view('reports.preview')->with('report_url', $report_url);
  }
}
