@extends('layouts.main')

@section('head')
<style media="screen">
  .delete-btn {
    border-radius: 100%;
    background-color:#454544;
    border-color: transparent;
    padding:0px;
    margin-right:2px;
    margin-left:2px;
    color:white;
    font-size:12px;
  }

  .delete-btn:hover {
    background-color:#57b0d3;
  }
</style>
@endsection

@section('content')
<section class="content-header">
  <h1>
    Viendo Empleado
    <small>{{ $employee->fullName }}</small>
  </h1>
</section>

@if ($errors->count() > 0)
<div class="container-fluid">
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach($errors->all() as $e)
    <p>* {{ $e }}</p>
    @endforeach
  </div>
</div>
@endif

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Informaci&oacute;n del Empleado</strong></h3>
            <div class="pull-right">
              @can('view reports')<a href="{{ route('reports.employees.license', $employee->id)}}" target="_new" class="btn btn-default btn-xs" title="Imprimir Carnet de licencia" data-placement="top" data-toggle="tooltip"><i class="fa fa-id-card-o"></i></a>@endcan
              @can('edit employees')
              <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar" data-placement="top">
                <i class="fa fa-pencil"></i>
              </a>
              @endcan
              @can('delete employees')
              {{Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'DELETE', 'class' => 'inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
              <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove" title="Borrar Empleado" data-toggle="tooltip" data-placement="top"></i></button>
              {{Form::close()}}
              @endcan
              <!-- Gender  -->
              @if ($employee->gender == 'M')
              <i class="fa fa-mars" data-toggle="tooltip" data-placement="top" title="Masculino"></i>
              @elseif ($employee->gender == 'F')
              <i class="fa fa-venus" data-toggle="tooltip" data-placement="top" title="Femenino"></i>
              @else
              <i class="fa fa-genderless" data-toggle="tooltip" data-placement="top" title="Indefinido"></i>
              @endif

              <!-- Status -->
              @if ($employee->status == 'activo')
              <i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" title="{{ $employee->status }}"></i>
              @elseif ($employee->status == 'parado')
              <i class="fa fa-circle text-warning" data-toggle="tooltip" data-placement="top" title="{{ $employee->status }}"></i>
              @elseif ($employee->status == 'cancelado')
              <i class="fa fa-circle text-danger" data-toggle="tooltip" data-placement="top" title="{{ $employee->status }}"></i>
              @else
              <i class="fa fa-circle" data-toggle="tooltip" data-placement="top" title="Indefinido"></i>
              @endif
            </div>
          </div>
          <div class="box-body">
            <img src="{{ ($employee->imgpath != null) ? asset('storage/'.$employee->imgpath) : asset('storage/img/page/no-image.png')}}" alt="" class="img img-responsive img-thumbnail" style="width: 120px; height: 120px">
            <br>
            <span><strong><i class="fa fa-tasks"></i> Proyecto: </strong> {{ $employee->project->name }}</span><br>
            <span><strong><i class="fa fa-calendar-times-o"></i> Turno: </strong> @empty($employee->shift) No definido @else {{ $employee->shift->name }}</span> @endempty <br>
            <span><strong><i class="fa fa-user-secret"></i> Supervisor: </strong> @empty($employee->shift) No definido @else {{ $employee->shift->supervisor->fullName }}</span> @endempty <br>
            <span><strong><i class="fa fa-flag"></i> Nacionalidad: </strong> @empty($employee->country ) No definido @else {{ $employee->country->name }} @endempty <br>
            <span><strong><i class="fa fa-id-card"></i> Codigo: </strong> {{ $employee->code }}</span><br>
            <span><strong><i class="fa fa-id-card-o"></i> Cedula: </strong> {{ $employee->identify_document }}</span><br>
            <span><strong><i class="fa fa-user-circle"></i> Nombres: </strong> {{ $employee->firstnames }}</span><br>
            <span><strong><i class="fa fa-user-circle"></i> Apellidos: </strong> {{ $employee->lastnames }}</span><br>
            <span><strong><i class="fa fa-user-circle"></i> Apodo: </strong> {{ $employee->nickname }}</span><br>
            <span><strong><i class="fa fa-calendar"></i> Fecha de Nacimiento: </strong> {{ $employee->latamBirthdate }}</span><br>
            <span><strong><i class="fa fa-calendar"></i> Fecha de Contrataci&oacute;n: </strong> {{ $employee->latamHiredate }}</span><br>
            <span><strong><i class="fa fa-heart"></i> Tipo de Sangre: </strong> {{ $employee->blood }}</span><br>
            <span><strong><i class="fa fa-tag"></i> Tipo de Empleado: </strong> {{ $employee->employee_type }}</span><br>
            <span><strong><i class="fa fa-tag"></i> Posici&oacute;n: </strong> {{ $employee->position }}</span><br>
            <span><strong><i class="fa fa-envelope"></i> Email: </strong> {{ $employee->email }}</span><br>
            <span><strong><i class="fa fa-phone"></i> Tel&eacute;fono: </strong> {{ $employee->phonenumber }}</span><br>
            <span><strong><i class="fa fa-mobile-phone"></i> Celular: </strong> {{ $employee->cellphone }}</span><br>
            <span><strong><i class="fa fa-map-marker"></i> Direcci&oacute;n: </strong> {{ $employee->address }}</span><br>
          </div>
          <!-- /.box-body -->
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-address-book"></i> <strong>Contactos y Emergencias </strong></h3>
            <div class="pull-right">
              <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#contacts-modal">
                <i class="fa fa-plus-circle" data-toggle="tooltip" title="Agregar Contacto" data-placement="top"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
            <div class="panel-group" id="">
              @foreach($employee->contacts as $contact)
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <strong>{{ $contact->firstnames.' '.$contact->lastnames}}</strong><br>
                    <i class="fa fa-phone"></i> {{$contact->phone}}
                    <a class="pull-right" data-toggle="collapse" data-parent="#{{$contact->id}}" href="#{{$contact->id}}">
                      <i class="fa fa-chevron-circle-down"></i>
                    </a>
                    {{ Form::open(['route' => ['contacts.destroy', $contact->id], 'method' => 'delete', 'class' => 'form inline pull-right', 'onClick' => 'return confirm("¿Desea borrar este registro?")'])}}
                    <button type="submit" class="delete-btn" title="Eliminar" data-placement="top" data-toggle="tooltip">
                      <i class="fa fa-close"></i>
                    </button>
                    {{ Form::close() }}
                    <a class="pull-right" href="{{ route('contacts.edit', $contact->id)}}" title="Editar" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </h4>
                </div>
                <div id="{{$contact->id}}" class="panel-collapse collapse">
                  <div class="panel-body">
                    <dl class="dl-horizontal">
                      <dt><strong><i class="fa fa-share-alt-square"></i> Relación</strong></dt>
                      <dd>{{ studly_case($contact->relation) }}</dd>
                      <dt><strong><i class="fa fa-phone"></i> Telefono</strong></dt>
                      <dd>{{ $contact->phone }}</dd>
                      <dt><strong><i class="fa fa-mobile-phone"></i> Celular</strong></dt>
                      <dd>{{ $contact->cell }}</dd>
                      <dt><strong><i class="fa fa-envelope-o"></i> Correo Electronico</strong></dt>
                      <dd>{{ $contact->email }}</dd>
                      <dt><strong><i class="fa fa-map-marker"></i> Direcci&oacute;n</strong></dt>
                      <dd>{{ $contact->address }}</dd>
                    </dl>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-drivers-license-o"></i>
              <strong>Licencia de Conducir</strong>
            </h3>
          </div>
          <div class="box-body">
            <span><strong><i class="fa fa-drivers-license"></i> No. Licencia: </strong> {{ $employee->drive_license }}</span><br>
            <span><strong><i class="fa fa-calendar"></i> Fecha de Emisi&oacute;n: </strong> {{ $employee->latamDriveLicenseStart }}</span><br>
            <span><strong><i class="fa fa-calendar"></i> Fecha de Vencimiento: </strong> {{ $employee->latamDriveLicenseEnd }}</span><br>
            <span><strong><i class="fa fa-tags"></i> Categoria: </strong> {{ $employee->drive_license_category }}</span><br>
            <span><strong><i class="fa fa-warning"></i> Restrici&oacute;n de Licencia: </strong> {{ $employee->drive_license_restriction }}</span><br>
          </div>
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-truck"></i>
              <strong>Equipos</strong>
            </h3>
            <div class="pull-right">
              @can('attach equipment_types')
              <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#equipments-modal">
                <i class="fa fa-plus-circle" data-toggle="tooltip" title="Agregar Equipo" data-placement="top"></i>
              </button>
              @endcan
            </div>
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Código</th>
                  <th><i class="fa fa-calendar"></i></th>
                  <th><i class="fa fa-folder-open"></i></th>
                  <th><i class="fa fa fa-drivers-license-o"></i></th>
                  <th><i class="fa fa-cog"></i></th>
                </tr>
                <tbody>
                  @foreach($employee->equipmentTypes as $equipment)
                  <tr>
                    <td><span data-toggle="tooltip" data-placement="top" title="{{ $equipment->name }}">{{ $equipment->code }} </span></td>
                    <td>{{ $equipment->pivot->date }}</td>
                    <td>
                      @empty($equipment->pivot->filepath)
                      <i class="fa fa-close" style="color:red"></i>
                      @else
                      <a href="{{ asset('storage/'.$equipment->pivot->filepath) }}" target="_new"><i class="fa fa-file-o"></i></a>
                      @endempty
                    </td>
                    <td>
                      @if ($equipment->pivot->carnet_print)
                      <i class="fa fa-check-square-o"></i>
                      @else
                      <i class="fa fa-square-o"></i>
                      @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-xs dropdown-toggle" type="button" id="" data-toggle="dropdown">
                          <i class="fa fa-cog"></i>
                          Opciones
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="">
                          @can('edit asigned equipment_types')<li><a href="{{ route('employees.equipments.edit', [$employee->id, $equipment->id])}}"><i class="fa fa-pencil"></i> Editar</a></li>@endcan
                          @can('detach equipment_types')<li><a href="{{route('employees.equipments.remove', [$employee->id, $equipment->id])}}" title="Quitar" data-toggle="tooltip" data-placement="top" onClick="return confirm('¿Eliminar registro?')"><i class="fa fa-trash"></i> Eliminar</a></li>@endcan
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </thead>
            </table>
          </div>
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><strong> <i class="fa fa-certificate"></i>Competencias </strong></h3>
            <div class="pull-right">
              @can('attach courses')
              <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#courses-modal">
                <i class="fa fa-plus-circle" data-toggle="tooltip" title="Agregar Competencia" data-placement="top"></i>
              </button>
              @endcan
            </div>
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Código</th>
                  <th><i class="fa fa-calendar"></i></th>
                  <th><i class="fa fa-folder-open"></i></th>
                  <th><i class="fa fa fa-drivers-license-o"></i></th>
                  <th><i class="fa fa-cog"></i></th>
                </tr>
                <tbody>
                  @foreach($employee->courses as $course)
                  <tr>
                    <td><span data-toggle="tooltip" data-placement="top" title="{{ $course->name }}">{{ $course->code }} </span></td>
                    <td>{{ $course->pivot->date }}</td>
                    <td>
                      @empty($course->pivot->filepath)
                      <i class="fa fa-close" style="color:red"></i>
                      @else
                      <a href="{{ asset('storage/'.$course->pivot->filepath) }}" target="_new"><i class="fa fa-file-o"></i></a>
                      @endempty
                    </td>
                    <td>
                      @if ($course->pivot->carnet_print)
                      <i class="fa fa-check-square-o"></i>
                      @else
                      <i class="fa fa-square-o"></i>
                      @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-xs dropdown-toggle" type="button" id="" data-toggle="dropdown">
                          <i class="fa fa-cog"></i>
                          Opciones
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="">
                          @can('edit asigned courses')<li><a href="{{ route('employees.courses.edit', [$employee->id, $course->id])}}"><i class="fa fa-pencil"></i> Editar</a></li>@endcan
                          @can('detach courses')<li><a href="{{route('employees.courses.remove', [$employee->id, $course->id])}}" title="Quitar" data-toggle="tooltip" data-placement="top" onClick="return confirm('¿Eliminar registro?')"><i class="fa fa-trash"></i> Eliminar</a></li>@endcan
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Add equipment modal form -->
<div class="modal fade" id="equipments-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">
          <i class="fa fa-plus-circle"></i>
          Agregar Equipo
        </h4>
      </div>
      {{ Form::open(['route' => ['employees.equipments.add', $employee->id], 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data'])}}
      <div class="modal-body">

        <!-- equipment_type_id -->
        <div class="form-group">
          {{Form::label('equipment_type_id', 'Equipo *', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::select('equipment_type_id', $equipmentTypes, old('equipment_type_id'), ['class' => 'form-control', 'placeholder' => 'Equipo'])}}
          </div>
        </div>

        <!-- date -->
        <div class="form-group">
          {{Form::label('date', 'Fecha *', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::date('date', old('date'), ['class' => 'form-control', 'placeholder' => 'Equipo'])}}
          </div>
        </div>

        <!-- filepath -->
        <div class="form-group">
          {{Form::label('', 'Archivo de Comprobación', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::file('filepath', ['placeholder' => 'Equipo'])}}
          </div>
        </div>

        <!-- carnet_print -->
        <div class="form-group">
          {{Form::label('carnet_print', 'Imprimir en Carnet', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{ Form::hidden('carnet_print', 0)}}
            {{Form::checkbox('carnet_print', 1, false)}}
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">
          <i class="fa fa-trash"></i>
          Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-floppy-disk"></i>
          Agregar
        </button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- Add course modal form -->
<div class="modal fade" id="courses-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">
          <i class="fa fa-plus-circle"></i>
          Agregar Competencias
        </h4>
      </div>
      {{ Form::open(['route' => ['employees.courses.add', $employee->id], 'class' => 'form form-horizontal', 'files' => true])}}
      <div class="modal-body">

        <!-- course_id -->
        <div class="form-group">
          {{Form::label('course_id', 'Competencia', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control', 'placeholder' => 'Competencia'])}}
          </div>
        </div>

        <!-- date -->
        <div class="form-group">
          {{Form::label('date', 'Fecha *', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::date('date', old('date'), ['class' => 'form-control', 'placeholder' => 'Fecha'])}}
          </div>
        </div>

        <!-- filepath -->
        <div class="form-group">
          {{Form::label('', 'Archivo de Comprobación', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::file('filepath', ['placeholder' => 'Archivo'])}}
          </div>
        </div>

        <!-- carnet_print -->
        <div class="form-group">
          {{Form::label('carnet_print', 'Imprimir en Carnet', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{ Form::hidden('carnet_print', 0) }}
            {{ Form::checkbox('carnet_print', 1, false) }}
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">
          <i class="fa fa-trash"></i>
          Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-floppy-disk"></i>
          Agregar
        </button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- Add contact to employee -->
<div class="modal fade" id="contacts-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">
          <i class="fa fa-address-book"></i>
          Agregar Contacto
        </h4>
      </div>
      {{ Form::open(['route' => ['contacts.store'], 'class' => 'form form-horizontal'])}}
      <div class="modal-body">

        <!-- firstnames -->
        <div class="form-group">
          {{Form::label('firstnames', 'Nombres', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::text('firstnames', old('firstnames'), ['class' => 'form-control', 'placeholder' => 'Nombres'])}}
          </div>
        </div>

        <!-- lastnames -->
        <div class="form-group">
          {{Form::label('lastnames', 'Apellidos', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::text('lastnames', old('lastnames'), ['class' => 'form-control', 'placeholder' => 'Apellidos'])}}
          </div>
        </div>

        <!-- email -->
        <div class="form-group">
          {{Form::label('email', 'Correo Electronico', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Electronico'])}}
          </div>
        </div>

        <!-- phone -->
        <div class="form-group">
          {{Form::label('phone', 'Telefono', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Telefono'])}}
          </div>
        </div>

        <!-- cell -->
        <div class="form-group">
          {{Form::label('cell', 'Celular', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::text('cell', old('cell'), ['class' => 'form-control', 'placeholder' => 'Celular'])}}
          </div>
        </div>

        <!-- address -->
        <div class="form-group">
          {{Form::label('address', 'Dirección', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            {{Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Dirección'])}}
          </div>
        </div>

        <!-- relation -->
        <div class="form-group">
          {{Form::label('address', 'Relación', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            <select class="form-control" name="relation">
              <option value=""selected disabled>Relación</option>
              @foreach(array_sort(App\Contacts::$relation) as $relation)
              @if($relation == old('relation'))
              <option value="{{ $relation}}" selected>{{ $relation }}</option>
              @else
              <option value="{{ $relation}}">{{ $relation }}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>

        <!-- employee_id -->
        {{ Form::hidden('employee_id', $employee->id)}}

      </div>

      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">
          <i class="fa fa-trash"></i>
          Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-floppy-disk"></i>
          Agregar
        </button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection
