@extends ('layouts.main')

@section('head')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Usuario
    <small>{{ $user->name }}</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-user"></i>
              Usuario: {{ $user->name }}
            </h3>
            <div class="pull-right">
              <div class="dropdown inline">
                <button class="btn btn-warning dropdown-toggle btn-xs" type="button" id="" data-toggle="dropdown">
                  Editar
                  <i class="fa fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="">
                  <li><a href="{{ route('users.edit', $user->id)}}"><i class="fa fa-pencil"></i> Editar Perfil </a></li>
                  <li><a href="{{ route('users.permissions', $user->id)}}"><i class="fa fa-lock"></i> Editar Permisos</a></li>
                </ul>
              </div>
              {{Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE', 'class' => 'form inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
              <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Borrar" data-placement="top">
                <i class="fa fa-close"></i>
              </button>
              {{ Form::close() }}
            </div>
          </div>
          <div class="box-centent">
            <div class="container-fluid">
              <div class="col-md-12">
                <img src="{{ ($user->imgpath != null) ? asset('storage/'.$user->imgpath) : asset('storage/img/page/no-image.png')}}" alt="" class="img img-responsive img-circle img-thumbnail" style="width:150px; height:150px"><br>
                <span><strong><i class="fa fa-user"></i> Nombre: </strong> {{ $user->name }}</span><br>
                <span><strong><i class="fa fa-envelope"></i> Correo Electronico: </strong> {{ $user->email }}</span><br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-lock"></i>
              Permisos
            </h3>
          </div>
          <div class="box-centent">
            <div class="container-fluid">
              <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <th><strong>Nombre Permiso</strong></th>
                    <th class="text-center"><i class="fa fa-square-o"></i></th>
                  </thead>
                  <tbody>
                    <!-- Administrator permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos administración </td>
                    </tr>
                    <tr>
                      <td>Administrador</td>
                      @if ($user->hasPermissionTo('administrator'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <!-- employees permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos sobre Empleados </td>
                    </tr>
                    <tr>
                      <td>Listar Empleados</td>
                      @if ($user->hasPermissionTo('list employees'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Crear Empleados</td>
                      @if ($user->hasPermissionTo('create employees'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Ver Empleado</td>
                      @if ($user->hasPermissionTo('view employees'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Modificar Empleado</td>
                      @if ($user->hasPermissionTo('edit employees'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Borrar Empleado</td>
                      @if ($user->hasPermissionTo('delete employees'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <!-- Equipment Types permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos sobre Tipos de Equipos </td>
                    </tr>
                    <tr>
                      <td>Listar Tipos de Equipos</td>
                      @if ($user->hasPermissionTo('list equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Crear Tipos de Equipos</td>
                      @if ($user->hasPermissionTo('create equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Ver Tipos de Equipos</td>
                      @if ($user->hasPermissionTo('view equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Modificar Tipos de Equipos</td>
                      @if ($user->hasPermissionTo('edit equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Borrar Tipos de Equipos </td>
                      @if ($user->hasPermissionTo('delete equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <!-- courses permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos sobre Competencias </td>
                    </tr>
                    <tr>
                      <td>Listar Competencias</td>
                      @if ($user->hasPermissionTo('list courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Crear Competencias</td>
                      @if ($user->hasPermissionTo('create courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Ver Competencias</td>
                      @if ($user->hasPermissionTo('view courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Modificar Competencias</td>
                      @if ($user->hasPermissionTo('edit courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Borrar Competencias </td>
                      @if ($user->hasPermissionTo('delete courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <!-- Projects permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos sobre Proyectos </td>
                    </tr>
                    <tr>
                      <td>Listar Proyectos</td>
                      @if ($user->hasPermissionTo('list projects'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Crear Proyectos</td>
                      @if ($user->hasPermissionTo('create projects'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Ver Proyectos</td>
                      @if ($user->hasPermissionTo('view projects'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Modificar Proyectos</td>
                      @if ($user->hasPermissionTo('edit projects'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Borrar Proyectos </td>
                      @if ($user->hasPermissionTo('delete projects'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <!-- Shifts permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos sobre Turnos </td>
                    </tr>
                    <tr>
                      <td>Listar Turnos</td>
                      @if ($user->hasPermissionTo('list shifts'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Crear Turnos</td>
                      @if ($user->hasPermissionTo('create shifts'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Ver Turnos</td>
                      @if ($user->hasPermissionTo('view shifts'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Modificar Turnos</td>
                      @if ($user->hasPermissionTo('edit shifts'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Borrar Turnos</td>
                      @if ($user->hasPermissionTo('delete shifts'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <!-- Reports permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos sobre Reportes </td>
                    </tr>
                    <tr>
                      <td>Ver Reportes</td>
                      @if ($user->hasPermissionTo('view reports'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <!-- Operational permissions view -->
                    <tr>
                      <td colspan="2" style="background-color: gray; color: white"> Permisos Operacionales </td>
                    </tr>
                    <tr>
                      <td>Agregar Tipos de Equipos a Empleado</td>
                      @if ($user->hasPermissionTo('attach equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Editar Tipos de Equipos asignados a Empleados</td>
                      @if ($user->hasPermissionTo('edit asigned equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Quitar Tipos de Equipos a Empleados</td>
                      @if ($user->hasPermissionTo('detach equipment_types'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Agregar Competencias a Empleado</td>
                      @if ($user->hasPermissionTo('attach courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Editar Competencias a Empleados</td>
                      @if ($user->hasPermissionTo('edit asigned courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                    <tr>
                      <td>Quitar Competencias a Empleados</td>
                      @if ($user->hasPermissionTo('detach courses'))
                      <td class="text-center"><i class="fa fa-check-square-o"></i></td>
                      @else
                      <td class="text-center"><i class="fa fa-square-o"></i></td>
                      @endif
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
