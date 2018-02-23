@extends ('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Usuarios
    <small>Permisos</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-unlock-alt"></i>
              <strong>Editar permisos para: </strong> {{ $user->name }} <small>({{ $user->email }})</small>
            </h3>
            <div class="pull-right">
            </div>
          </div>
          <div class="box-content">
            <div class="container-fluid">
              {{ Form::open(['route' => ['users.permissions', $user->id]]) }}
              <div class="row">
                <!-- Employees permissions -->
                <div class="col-md-4">
                  <h3>Empleados</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="list employees" {{ ($user->hasPermissionTo('list employees')) ? 'checked' : ''}}> Listar empleados <br>
                <input type="checkbox" name="permissions[]" value="view employees" {{ ($user->hasPermissionTo('view employees')) ? 'checked' : ''}}> Ver empleados <br>
                <input type="checkbox" name="permissions[]" value="create employees" {{ ($user->hasPermissionTo('create employees')) ? 'checked' : ''}}> Crear empleados <br>
                <input type="checkbox" name="permissions[]" value="edit employees" {{ ($user->hasPermissionTo('edit employees')) ? 'checked' : ''}}> Editar empleados <br>
                <input type="checkbox" name="permissions[]" value="delete employees" {{ ($user->hasPermissionTo('delete employees')) ? 'checked' : ''}}> Borrar empleados <br>
                </div>

                <!-- Equipment_types permissions -->
                <div class="col-md-4">
                  <h3>Tipos de Equipos</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="list equipment_types" {{ ($user->hasPermissionTo('list equipment_types')) ? 'checked' : ''}}> Listar Equipos <br>
                <input type="checkbox" name="permissions[]" value="view equipment_types" {{ ($user->hasPermissionTo('view equipment_types')) ? 'checked' : ''}}> Ver Equipos <br>
                <input type="checkbox" name="permissions[]" value="create equipment_types" {{ ($user->hasPermissionTo('create equipment_types')) ? 'checked' : ''}}> Crear Equipos <br>
                <input type="checkbox" name="permissions[]" value="edit equipment_types" {{ ($user->hasPermissionTo('edit equipment_types')) ? 'checked' : ''}}> Editar Equipos <br>
                <input type="checkbox" name="permissions[]" value="delete equipment_types" {{ ($user->hasPermissionTo('delete equipment_types')) ? 'checked' : ''}}> Borrar Equipos <br>
                </div>

                <!-- Courses permissions -->
                <div class="col-md-4">
                  <h3>Competencias</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="list courses" {{ ($user->hasPermissionTo('list courses')) ? 'checked' : ''}}> Listar Competencias <br>
                <input type="checkbox" name="permissions[]" value="view courses" {{ ($user->hasPermissionTo('view courses')) ? 'checked' : ''}}> Ver Competencias <br>
                <input type="checkbox" name="permissions[]" value="create courses" {{ ($user->hasPermissionTo('create courses')) ? 'checked' : ''}}> Crear Competencias <br>
                <input type="checkbox" name="permissions[]" value="edit courses" {{ ($user->hasPermissionTo('edit courses')) ? 'checked' : ''}}> Editar Competencias <br>
                <input type="checkbox" name="permissions[]" value="delete courses" {{ ($user->hasPermissionTo('delete courses')) ? 'checked' : ''}}> Borrar Competencias <br>
                </div>
              </div>
              <div class="row">
                <!-- Projects permissions -->
                <div class="col-md-4">
                  <h3>Proyectos</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="list projects" {{ ($user->hasPermissionTo('list projects')) ? 'checked' : ''}}> Listar Proyectos   <br>
                <input type="checkbox" name="permissions[]" value="view projects" {{ ($user->hasPermissionTo('view projects')) ? 'checked' : ''}}> Ver Proyectos <br>
                <input type="checkbox" name="permissions[]" value="create projects" {{ ($user->hasPermissionTo('create projects')) ? 'checked' : ''}}> Crear Proyectos <br>
                <input type="checkbox" name="permissions[]" value="edit projects" {{ ($user->hasPermissionTo('edit projects')) ? 'checked' : ''}}> Editar Proyectos <br>
                <input type="checkbox" name="permissions[]" value="delete projects" {{ ($user->hasPermissionTo('delete projects')) ? 'checked' : ''}}> Borrar Proyectos <br>
                </div>

                <!-- Group permissions -->
                <div class="col-md-4">
                  <h3>Grupos</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="list groups" {{ ($user->hasPermissionTo('list groups')) ? 'checked' : ''}}> Listar Grupos   <br>
                <input type="checkbox" name="permissions[]" value="view groups" {{ ($user->hasPermissionTo('view groups')) ? 'checked' : ''}}> Ver Grupos <br>
                <input type="checkbox" name="permissions[]" value="create groups" {{ ($user->hasPermissionTo('create groups')) ? 'checked' : ''}}> Crear Grupos <br>
                <input type="checkbox" name="permissions[]" value="edit groups" {{ ($user->hasPermissionTo('edit groups')) ? 'checked' : ''}}> Editar Grupos <br>
                <input type="checkbox" name="permissions[]" value="delete groups" {{ ($user->hasPermissionTo('delete groups')) ? 'checked' : ''}}> Borrar Grupos <br>
                </div>

                <!-- View Reports permissions -->
                <div class="col-md-4">
                  <h3>Reportes</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="view reports" {{ ($user->hasPermissionTo('view reports')) ? 'checked' : ''}}> Ver Reportes<br>
                </div>
              </div>
              <div class="row">
                <!-- Operations permissions -->
                <div class="col-md-4">
                  <h3>Operaciones</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="attach equipment_types" {{ ($user->hasPermissionTo('attach equipment_types')) ? 'checked' : ''}}> Agregar Equipos a empleado <br>
                <input type="checkbox" name="permissions[]" value="detach equipment_types" {{ ($user->hasPermissionTo('detach equipment_types')) ? 'checked' : ''}}> Quitar equipos a empleado <br>
                <input type="checkbox" name="permissions[]" value="edit asigned equipment_types" {{ ($user->hasPermissionTo('edit asigned equipment_types')) ? 'checked' : ''}}> Editar equipos a empleado <br>
                <input type="checkbox" name="permissions[]" value="attach courses" {{ ($user->hasPermissionTo('attach courses')) ? 'checked' : ''}}> Agregar competencias a empleado <br>
                <input type="checkbox" name="permissions[]" value="detach courses" {{ ($user->hasPermissionTo('detach courses')) ? 'checked' : ''}}> Quitar competencias a empleado <br>
                <input type="checkbox" name="permissions[]" value="edit asigned courses" {{ ($user->hasPermissionTo('edit asigned courses')) ? 'checked' : ''}}> Editar competencias a empleado <br>
                </div>

                <!-- Administration permissions -->
                <div class="col-md-4">
                  <h3>Administración</h3>
                  <hr>
                <input type="checkbox" name="permissions[]" value="administrator" {{ ($user->hasPermissionTo('administrator')) ? 'checked' : ''}}> Super Usuario <br>
                </div>

              </div>
              <hr>
              <div class="pull-right">
                <button type="button" class="btn btn-warning" onclick="history.back()">
                  <i class="fa fa-arrow-left"></i>
                  Cancelar
                </button>
                <button type="" class="btn btn-primary">
                  <i class="fa fa-save"></i>
                  Guardar
                </button>
              </div>
              <div class="clearfix"></div>
              <p></p>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
@endsection
