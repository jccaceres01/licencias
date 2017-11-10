<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeesRequest;
use App\Employees;
use App\EquipmentTypes;
use App\Projects;
use App\Shifts;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $emp = Employees::orderBy('code')->search($request->criteria)
        ->paginate(10);

      return view('employees.index')->with('employees', $emp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('employees.create')->with([
        'projects' => Projects::orderBy('name')->pluck('name', 'id'),
        'shifts' => Shifts::orderBy('name')->pluck('name', 'id')
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesRequest $request)
    {
      try {
        $emp = Employees::create($request->except(['imgpath']));

        if ($request->hasFile('imgpath')) {
            $path = $request->imgpath->store('img/employees', 'public');
            $emp->imgpath = $path;
            $emp->save();

            \Notify::success('Empleado creado correctamente',
              '<strong>Información</strong>');
            return redirect()->route('employees.show', $emp->id);
        }
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e->getMessage(), 'Error '.$e->getCode().': ');
            return redirect()->back()->withInput();
        }
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
      return view('employees.show')->with([
        'employee' => Employees::find($id),
        'equipmentTypes' => EquipmentTypes::orderBy('name')
          ->pluck('name', 'id')
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('employees.edit')->with([
        'employee' => Employees::find($id),
        'projects' => Projects::orderBy('name')->pluck('name', 'id'),
        'shifts' => Shifts::orderBy('name')->pluck('name', 'id')
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesRequest $request, $id)
    {
      $emp = Employees::find($id);

      try {
        $emp->update($request->except('imgpath'));

        if ($request->hasFile('imgpath')) {
          if ($emp->imgpath != null) {
            $oldpath = $emp->imgpath;
            $path = $request->imgpath->store('img/employees', 'public');
            $emp->imgpath = $path;
            $emp->save();

            \Storage::drive('public')->delete($oldpath);
          } else {
            $path = $request->imgpath->store('img/employees', 'public');
            $emp->imgpath = $path;
            $emp->save();
          }
        }

        \Notify::success('Empleado modificado correctamente',
          '<strong>Información</strong>');
        return redirect()->route('employees.show', $emp->id);
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e->getCode(), 'Error '.$e->getCode());
            return redirect()->back()->withInput();
        }
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
      $emp = Employees::find($id);
      $oldpath = $emp->imgpath;

      try {
        $emp->delete();

        if($oldpath != null || trim($oldpath) != '') {
          \Storage::drive('public')->delete($oldpath);
        }

        \Notify::success('Empleado borrado correctamente',
          '<strong>Información</strong>');
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          case '23000':
            \Notify::error('Otros registros dependen de este,
              primero borre las dependencias.', 'Error '.$e->getCode().': ');
            return redirect()->back();
          default:
            \Notify::error($e->getMessage(), 'Error '.$e->getCode().': ');
            return redirect()->back();
        }
      }

      \Notify::success('Empleado borrado correctamente',
        '<strong>Información</strong>');
      return redirect()->route('employees.index');
    }

    /**
     * Add Equipment to employee
     */
    public function addEquipment(Request $request, $employee_id) {
      $employee = Employees::find($employee_id);

      if ($request->has('equipment_type_id')) {
        try {
          $employee->equipmentTypes()->attach($request->equipment_type_id);
          \Notify::success('Equipo agregado', 'Información');
          return redirect()->route('employees.show', $employee->id);
        } catch (\Exception $e) {
          switch ($e->getCode()) {
            case '23000':
              \Notify::error('Este  equipo ya  esta asignado', 'Error');
              return redirect()->back();
            default:
              \Notify::error($e->getMessage(), 'Error: '. $e->getCode());
              return redirect()->back();
          }
        }
      } else {
        \Notify::error('No se recivio el parametro', 'Información');
        return redirect()->back();
      }
    }

  /**
   * Remove equipment from employee
   */
  public function removeEquipment($employee_id, $equipment_type_id) {
    $employee = Employees::find($employee_id);

    try {
      $employee->equipmentTypes()->detach($equipment_type_id);
      \Notify::success('Equipo removido', 'Información');
      return redirect()->route('employees.show', $employee->id);
    } catch (\Exception $e) {
      switch ($e->getCode()) {
        default:
          \Notify::error($e->getMessage(), 'Error: '.$e->getCode());
          return redirect()->back();
      }
    }
  }
}
