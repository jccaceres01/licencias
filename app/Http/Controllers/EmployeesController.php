<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeesRequest;
use App\Http\Requests\Employees\EditEmployeesEquipmentRequest;
use App\Http\Requests\Employees\EmployeesEquipmentRequest;
use App\Http\Requests\Employees\EmployeesCoursesRequest;
use App\Http\Requests\Employees\EditEmployeesCourseRequest;
use App\Models\Employees;
use App\Models\EquipmentTypes;
use App\Models\Courses;
use App\Models\Projects;
use App\Models\Groups;
use App\Models\MaEmpl;

// Include Helpers
use Illuminate\Support\Str;

class EmployeesController extends Controller
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
      if (\Auth::user()->can('list employees')) {
        $emp = Employees::orderBy('code')->activeAndStandBy()
          ->search($request->criteria)
          ->paginate(10);
        return view('employees.index')->with('employees', $emp);
      } else {
          \Notify::warning('No tiene acceso para ver empleados', 'Información');
          return redirect()->back();
      }
    }

    /**
     * Get canceled employees
     */
    public function getDownEmployees(Request $request) {
      if (\Auth::user()->can('list employees')) {
        $downCount = Employees::down()->count();
        $employees = Employees::down()
          ->orderBy('code')
          ->search($request->criteria)
          ->paginate(10);
        return view('employees.down')->with([
          'employees' => $employees,
          'downCount' => $downCount
        ]);
      } else {
          \Notify::warning('No tiene acceso para ver empleados', 'Información');
          return redirect()->back();
      }
    }

    /**
     * Get employees with expired licenses
     */
    public function expiredLicenses(Request $request) {
      if (\Auth::user()->can('list employees')) {
        $today = new \DateTime('today');
        $emp = Employees::orderBy('code')->activeAndStandBy()
          ->search($request->criteria)
          ->where('drive_license_end', '<', $today->format('y-m-d'))
          ->paginate(10);
        return view('employees.expired-licenses')->with([
          'employees' => $emp,
          'expiredCount' => Employees::activeAndStandBy()
            ->where('drive_license_end', '<', $today->format('y-m-d'))->count()
        ]);
      } else {
          \Notify::warning('No tiene acceso para ver empleados', 'Información');
          return redirect()->back();
      }
    }

    /**
     * Show employees with licenses next to expire
     */
    public function nextToExpire(Request $request) {
      if (\Auth::user()->can('list employees')) {
        $today = new \DateTime('today');
        $threeMonths = new \DateTime('+3 months');

        $emp = Employees::orderBy('code')->activeAndStandBy()
          ->search($request->criteria)
          ->whereBetween('drive_license_end', [
              $today->format('y-m-d'),
              $threeMonths->format('y-m-d')
          ])
          ->paginate(10);
        return view('employees.next-to-expired-licenses')->with([
          'employees' => $emp,
          'nextToExpireCount' => Employees::activeAndStandBy()
          ->whereBetween('drive_license_end', [
              $today->format('y-m-d'),
              $threeMonths->format('y-m-d')
          ])->count()
        ]);
      } else {
          \Notify::warning('No tiene acceso para ver empleados', 'Información');
          return redirect()->back();
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->can('create employees')) {
        return view('employees.create')->with([
          'projects' => Projects::orderBy('name')->pluck('name', 'id'),
          'groups' => Groups::orderBy('name')->pluck('name', 'id')
        ]);
      } else {
        \Notify::warning('No tiene privilegios para crear empleados'
          , 'Información');
        return redirect()->back();
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesRequest $request)
    {
      if (\Auth::user()->can('create employees')) {
        try {
          $emp = Employees::create($request->except(['imgpath']));

          if ($request->hasFile('imgpath')) {
              $path = $request->imgpath->store('img/employees', 'public');
              $emp->imgpath = $path;
              $emp->save();
          }

          \Notify::success('Empleado creado correctamente',
            '<strong>Información</strong>');
          return redirect()->route('employees.show', $emp->id);

        } catch (\Exception $e) {
          switch ($e->getCode()) {
            default:
              \Notify::error($e->getMessage(), 'Error '.$e->getCode().': ');
              return redirect()->back()->withInput();
          }
        }
      } else {
        \Notify::warning('No tiene privilegios para crear empleados',
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
      if (\Auth::user()->can('view employees')) {
        return view('employees.show')->with([
          'employee' => Employees::find($id),
          'equipmentTypes' => EquipmentTypes::orderBy('name')
            ->pluck('name', 'id'),
          'courses' => Courses::orderBy('name')->pluck('name', 'id')
        ]);
      } else {
        \Notify::warning('No tiene privilegios para ver los datos del empleado',
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
      if (\Auth::user()->can('edit employees')) {
        return view('employees.edit')->with([
          'employee' => Employees::find($id),
          'projects' => Projects::orderBy('name')->pluck('name', 'id'),
          'groups' => Groups::orderBy('name')->pluck('name', 'id')
        ]);
      } else {
        \Notify::warning('No tiene privilegios para editar
        los datos del empleado', 'Información');
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
    public function update(EmployeesRequest $request, $id)
    {
      if (\Auth::user()->can('edit employees')) {
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
              \Notify::error($e->getCode(), 'Error '.$e->getMessage());
              return redirect()->back()->withInput();
          }
        }
      } else {
        \Notify::warning('No tiene los permisos para borrar empleados',
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
      if (\Auth::user()->can('delete employees')) {
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
      } else {
        \Notify::warning('No tiene privilegios para borrar el empleado',
          'Información');
        return redirect()->back();
      }
    }

    /**
     * Add Equipment to employee
     */
    public function addEquipment(
      EmployeesEquipmentRequest $request,
      $employee_id
    ) {

      if (\Auth::user()->can('attach equipment_types')) {
        $employee = Employees::find($employee_id);
        $filepath = null;

          if ($request->hasfile('filepath')) {
            $filepath = $request->filepath
              ->store('docs/employees_equipment_types', 'public');
          }

          try {
            $employee->equipmentTypes()->attach($request->equipment_type_id, [
              'date' => $request->date,
              'filepath' => $filepath,
              'carnet_print' => $request->carnet_print
            ]);

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
        \Notify::warning('No tiene los permisos para asignar equipos',
          'Información');
        return redirect()->back();
      }
    }

  /**
   * Remove equipment from employee
   */
  public function removeEquipment($employee_id, $equipment_type_id) {

    if (\Auth::user()->can('detach equipment_types')) {
      $employee = Employees::find($employee_id);
      $filepath = $employee->equipmentTypes()->find($equipment_type_id)
        ->pivot->filepath;

      if  ($filepath != null) {
        \Storage::disk('public')->delete($filepath);
      }

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
    } else {
      \Notify::warning('No tiene los permisos para quitar equipos',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Add course to employee
   */
  public function addCourse(
    EmployeesCoursesRequest $request,
    $employee_id
  ) {

    if (\Auth::user()->can('attach courses')) {
      $employee = Employees::find($employee_id);
      $filepath = null;

        if ($request->hasfile('filepath')) {
          $filepath = $request->filepath
            ->store('docs/employees_courses', 'public');
        }

        try {
          $employee->courses()->attach($request->course_id, [
            'date' => $request->date,
            'filepath' => $filepath,
            'carnet_print' => $request->carnet_print
          ]);

          \Notify::success('Competencia Agregada', 'Información');
          return redirect()->route('employees.show', $employee->id);
        } catch (\Exception $e) {
          switch ($e->getCode()) {
            case '23000':
              \Notify::error('Esta Competencia ya esta asignada', 'Error');
              return redirect()->back();
            default:
              \Notify::error($e->getMessage(), 'Error: '. $e->getCode());
              return redirect()->back();
          }
        }
    } else {
      \Notify::warning('No tiene los permisos para asignar competencias',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Add courses to multiple employees
   */
  public function addCourseMassive(Request $request) {
    if (!\Auth::user()->can('attach courses')) {
      \Notify::warning('No tiene los permisos para asignar competencias',
        'Información');
      return redirect()->back();
    }

    if ($request->has('employee_id') && $request->has('course_id')) {
      $filepath = null;
      $course = Courses::find($request->course_id);

      if ($request->hasFile('filepath')) {
        $filepath = $request->filepath->store('docs/employees_courses',
          'public');
      }

      foreach($request->employee_id as $empid) {
        $emp = Employees::find($empid);

        if ($emp->courses->pluck('id')->contains($request->course_id)) {
          foreach($emp->courses as $course ) {
            $newDate = new \DateTime($request->date);
            $oldDate = new \DateTime($course->pivot->date);

            if ($newDate > $oldDate && $course->id == $request->course_id) {
              $emp->courses()->updateExistingPivot($course->id, [
                'date' => $newDate->format('y-m-d'),
                'filepath' => $filepath,
                'carnet_print' => $request->carnet_print
              ]);
            }
          }
        } else {
          $emp->courses()->attach($course, [
            'date' => $request->date,
            'filepath' => $filepath,
            'carnet_print' => $request->carnet_print
          ]);
        }
      }

      \Notify::success('Asignación masiva completada', 'Información');
      return redirect()->back();
    } else {
      \Notify::error('Faltan parametros', 'Información');
      return redirect()->back();
    }
  }

  /**
   * Remove course from employee
   */
  public function removeCourse($employee_id, $course_id) {

    if (\Auth::user()->can('detach courses')) {
      $employee = Employees::find($employee_id);
      $filepath = $employee->courses()->find($course_id)
        ->pivot->filepath;

      if  ($filepath != null) {
        \Storage::disk('public')->delete($filepath);
      }

      try {
        $employee->courses()->detach($course_id);
        \Notify::success('Competencia removida', 'Información');
        return redirect()->route('employees.show', $employee->id);
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e->getMessage(), 'Error: '.$e->getCode());
            return redirect()->back();
        }
      }
    } else {
      \Notify::warning('No tiene los permisos para quitar competencias',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Show Edit form for employee's equipment type
   */
  public function editEmployeeEquipments($employee_id, $equipment_type_id) {
    if (\Auth::user()->can('edit asigned equipment_types')) {
      $employee = Employees::find($employee_id);
      $equipmentType = EquipmentTypes::find($equipment_type_id);

      return view('employees.equipments')->with([
        'employee' => $employee,
        'equipmentType' => $equipmentType
      ]);
    } else {
      \Notify::warning('No tiene privilegios para editar equipos asignados',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Update employee's equipment data
   */
  public function updateEmployeesEquipments(
    EditEmployeesEquipmentRequest $request,
    $employee_id,
    $equipment_type_id
  ) {
    if (\Auth::user()->can('edit asigned equipment_types')) {
      $employee = Employees::find($employee_id);
      $equipmentType = EquipmentTypes::find($equipment_type_id);

      $filepath = $employee->equipmentTypes()->find($equipment_type_id)->pivot
        ->filepath;

      if ($request->hasFile('filepath')) {
        if ($filepath != null) {
          \Storage::disk('public')->delete($filepath);
          $filepath = $request->filepath->store('/docs/employees_equipment_types',
            'public');
        } else {
          $filepath = $request->filepath->store('/docs/employees_equipment_types',
            'public');
        }
      }

      try {
        $employee->equipmentTypes()->updateExistingPivot($equipmentType->id, [
          'date' => $request->date,
          'filepath' => $filepath,
          'carnet_print' => $request->carnet_print
        ]);

        \Notify::success('Registro modificado correctamente', 'Información');
        return redirect()->route('employees.show', $employee->id);

      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e->getMessage(), 'Error: ');
          return redirect()->back();
        }
      }
    } else {
      \Notify::warning('No tiene privilegios para editar equipos asignados',
        'Información');
      return redirect()->back();
    }
  }

  /**
   * Show Edit form for employee's course
   */
  public function editEmployeeCourses($employee_id, $course_id) {
    if (\Auth::user()->can('edit asigned courses')) {
      $employee = Employees::find($employee_id);
      $course = Courses::find($course_id);

      return view('employees.courses')->with([
        'employee' => $employee,
        'course' => $course
      ]);
    } else {
      \Notify::warning('No tiene privilegios para editar
        competencias asignadas', 'Información');
      return redirect()->back();
    }
  }

  /**
   * Update employee's course data
   */
  public function updateEmployeesCourses(
    EditEmployeesCourseRequest $request,
    $employee_id,
    $course_id
  ) {
    if (\Auth::user()->can('edit asigned courses')) {
      $employee = Employees::find($employee_id);
      $course = Courses::find($course_id);

      $filepath = $employee->courses()->find($course_id)->pivot
        ->filepath;

      if ($request->hasFile('filepath')) {
        if ($filepath != null) {
          \Storage::disk('public')->delete($filepath);
          $filepath = $request->filepath->store('/docs/employees_courses',
            'public');
        } else {
          $filepath = $request->filepath->store('/docs/employees_courses',
            'public');
        }
      }

      try {
        $employee->courses()->updateExistingPivot($course->id, [
          'date' => $request->date,
          'filepath' => $filepath,
          'carnet_print' => $request->carnet_print
        ]);

        \Notify::success('Registro modificado correctamente', 'Información');
        return redirect()->route('employees.show', $employee->id);

      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e->getMessage(), 'Error: ');
          return redirect()->back();
        }
      }
    } else {
      \Notify::warning('No tiene privilegios para editar
        competencias asignadas', 'Información');
      return redirect()->back();
    }
  }

  /**
   * Reactivate a down employee
   */
  public function up($employee_id) {
    $emp = Employees::find($employee_id);

    try {
        $emp->status = 'activo';
        $emp->save();

        \Notify::success('Empleado reactivado', 'Información');
        return redirect()->route('employees.show', $emp->id);

    } catch (\Exception $e) {
      switch ($e->getCode()) {
        default:
          \Notify::error( $e->getMessage(), 'Error: '.$e->getCode());
          return redirect()->back();
      }
    }
  }

  /**
   * Change employee's status to down
   */
  public function down($employee_id) {

    $emp = Employees::find($employee_id);

    try {
        $emp->status = 'cancelado';
        $emp->save();

        \Notify::success('Empleado puesto de baja', 'Información');
        return redirect()->back();

    } catch (\Exception $e) {
      switch ($e->getCode()) {
        default:
          \Notify::error( $e->getMessage(), 'Error: '.$e->getCode());
          return redirect()->back();
      }
    }
  }

  /**
   * Map Employees from MaEmpl (PlanillaRD) to Employees 
   * 
   * For now this only work with MaEmpl with CodMER = 3(Activos) and CodSGE = 32 (Administrativos)
   */
  public function syncEmployees() {

    try {
      \DB::beginTransaction();

      $maEmpl = MaEmpl::where('CodMER', 3)->where('CodSGE', 32)->get(); // Get employees from planillaRd
      $employees = Employees::all(); // Get employees from licencias
      $project = Projects::where('name', 'like', '%TCB%')->first(); // Get Project TCB only for
      
      // Fire all exists employees
      foreach ($employees as $employee) {
        $employee->status = 'cancelado';
        $employee->save();
      }

      // Find, update or create if not found employees matching with planillaRD
      foreach ($maEmpl as $planillaEmployee) {
        if ($employees->contains('code', trim($planillaEmployee->CodMEm))) {
          $emp = Employees::where('code', trim($planillaEmployee->CodMEm))->first();

          $emp->firstnames = trim($planillaEmployee->Nombr1).' '.trim($planillaEmployee->Nombr2);
          $emp->lastnames = trim($planillaEmployee->Apell1).' '.trim($planillaEmployee->Apell2);
          $emp->identity_document = trim($planillaEmployee->Cedula);
          $emp->birthdate = $planillaEmployee->FecNac;
          $emp->hiredate = $planillaEmployee->FecIng;
          $emp->project_id = $project->id;
          $emp->status = 'activo';
          $emp->save();
        } else {
          info('Employee with Code: '.$planillaEmployee->CodMEm.' Not Found in Employees and will be create');
          Employees::create([
            'code' => trim($planillaEmployee->CodMEm),
            'firstnames' => trim($planillaEmployee->Nombr1).' '.trim($planillaEmployee->Nombr2),
            'lastnames' => trim($planillaEmployee->Apell1).' '.trim($planillaEmployee->Apell2),
            'identity_document' => $planillaEmployee->Cedula,
            'birthdate' => $planillaEmployee->FecNac,
            'hiredate' => $planillaEmployee->FecIng,
            'project_id' => $project->id,
            'status' => 'activo'
          ]);
        }
      }
      // Commit transaction
      \DB::commit();

      \Notify::success('Usuarios Sincronizados', 'Informaci&oacute;n');
      return back();
    } catch (\Exception $e) {
      switch ($e->getCode()) {
        default:
          \Notify::error( $e->getMessage(), 'Error: '.$e->getCode());
          info($e);
          break;
      }
      // Rollback transaction on issue
      \DB::rollBack();
      return back();
    }
  }
}
