<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GroupsRequest;
use App\Groups;
use App\Employees;
use App\Projects;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $groups = Groups::search($request->criteria)->orderBy('name')
        ->paginate(5);
      return view('groups.index')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->can('create groups')) {
        return view('groups.create')->with([
          'supervisors' => Employees::where(
              'employee_type', 'supervisor'
            )->orderBy('firstnames')->get(),
          'projects' => Projects::orderBy('name')->pluck('name', 'id')
        ]);
      } else {
        \Notify::warning('No tiene privilegios para crear Grupos',
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
    public function store(GroupsRequest $request)
    {
      if (\Auth::user()->can('create groups')) {
        try {
          $group = Groups::create($request->all());
          \Notify::success('Grupo agregado', 'Información');
          return redirect()->route('groups.show', $group->id);
        } catch (\Exception $e) {
          switch ($e->getCode()) {
            case '23000':
              \Notify::error('Este campo ya existe', '<strong>Error</strong>');
              return redirect()->back();
            default:
              \Notify::error($e->getMessage(), '<strong>Error '.$e->getCode().
                '</strong>');
              return redirect()->back();
          }
        }
      } else {
        \Notify::warning('No tiene privilegios para crear Grupos',
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
      if (\Auth::user()->can('view groups')) {
        return view('groups.show')->with('group', Groups::find($id));
      } else {
        \Notify::warning('No tiene privilegios para crear Grupos',
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
      if (\Auth::user()->can('edit groups')) {
        return view('groups.edit')->with([
          'supervisors' => Employees::where(
              'employee_type', 'supervisor'
            )->orderBy('firstnames')->get(),
          'projects' => Projects::orderBy('name')->pluck('name', 'id'),
          'group' => Groups::find($id)
        ]);
      } else {
        \Notify::warning('No tiene privilegios para crear Grupos',
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
    public function update(GroupsRequest $request, $id)
    {
      if (\Auth::user()->can('edit groups')) {
        $group = Groups::find($id);

        try {
          $group->update($request->all());
          \Notify::success('Grupo actualizado', '<strong>Información</strong>');
          return redirect()->route('groups.show', $group->id);
        } catch (\Exception $e) {
          switch ($e->getCode()) {
            case '23000':
              \Notify::error('Este grupo ya existe', '<strong>Error</strong>');
              return redirect()->back();
            default:
              \Notify::error($e->getMessage(), '<strong>Error '.$e->getCode()
                .'</strong>');
              return redirect()->back();
          }
        }
      } else {
        \Notify::warning('No tiene privilegios para crear Grupos',
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
      if (\Auth::user()->can('delete groups')) {
        try {
          Groups::destroy($id);
          \Notify::success('Grupo borrado', '<strong>Información</strong>');
          return redirect()->route('groups.index');
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
        \Notify::warning('No tiene privilegios para crear Grupos',
          'Información');
        return redirect()->back();
      }
    }
}
