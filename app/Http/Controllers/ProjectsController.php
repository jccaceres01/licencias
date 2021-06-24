<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectsRequest;
use App\Models\Projects;
use App\Models\Countries;
use App\Models\Employees;


class ProjectsController extends Controller
{
  /**
   * Contructor
   */
  public function __construct() {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $projects = Projects::search($request->criteria)->orderBy('name')
      ->paginate(5);
    return view('Projects.index')->with('projects', $projects);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    if (\Auth::user()->can('create projects')) {
      return view('projects.create')->with([
        'countries' => Countries::orderBy('name')->pluck('name', 'id'),
        'generalSupervisor' => Employees::where(
            'employee_type', 'supervisor general')->orderBy('firstnames')
            ->get()
      ]);
    } else {
      \Notify::warning('No tiene privilegios para crear projectos',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProjectsRequest $request)
  {
    if (\Auth::user()->can('create projects')) {
      try {
        $project = Projects::create($request->all());
        \Notify::success('Proyecto agregado', 'Información');
        return redirect()->route('projects.show', $project->id);
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          case '23000':
            \Notify::error('Este registro ya existe', '<strong>Error</strong>');
            return redirect()->back()->withInput();
          default:
            \Notify::error($e->getMessage(), '<strong>Error '.$e->getCode().
              '</strong>');
            return redirect()->back()->withInput();
        }
      }
    } else {
      \Notify::warning('No tiene privilegios para crear projectos',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    if (\Auth::user()->can('view projects')) {
      return view('projects.show')->with('project', Projects::find($id));
    } else {
      \Notify::warning('No tiene privilegios para ver projectos',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    if (\Auth::user()->can('edit projects')) {
      return view('projects.edit')->with([
        'countries' => Countries::orderBy('name')->pluck('name', 'id'),
        'generalSupervisor' => Employees::where(
            'employee_type', 'supervisor general')->orderBy('firstnames')
            ->get(),
        'project' => Projects::find($id)
      ]);
    } else {
      \Notify::warning('No tiene privilegios para editar projectos',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProjectsRequest $request, $id)
  {
    if (\Auth::user()->can('edit projects')) {
      $project = Projects::find($id);

      try {
        $project->update($request->all());
        \Notify::success('Proyecto actualizado', '<strong>Información</strong>');
        return redirect()->route('projects.show', $project->id);
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          case '23000':
            \Notify::error('Este proyecto ya existe', '<strong>Error</strong>');
            return redirect()->back()->withinput();
          default:
            \Notify::error($e->getMessage(), '<strong>Error '.$e->getCode()
              .'</strong>');
            return redirect()->back()->withInput();
        }
      }
    } else {
      \Notify::warning('No tiene privilegios para editar projectos',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (\Auth::user()->can('delete projects')) {
      try {
        Projects::destroy($id);
        \Notify::success('Proyecto borrado', '<strong>Información</strong>');
        return redirect()->route('projects.index');
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          case '23000':
            \Notify::error('Otros registros dependen de este',
              '<strong>Error</strong>');
            return redirect()->back();
          default:
          \Notify::error($e->getMessage(),'<strong>Error '.$e->getCode()
            .'</strong>');
          return redirect()->back();
        }
      }
    } else {
      \Notify::warning('No tiene privilegios para eliminar projectos',
        'Información');
      return redirect()->back();
    }
  }
}
