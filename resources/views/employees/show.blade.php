@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Viendo Empleado
    <small>{{ $employee->fullName }}</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>Informaci&oacute;n del Empleado</strong></h3>
            <div class="pull-right">
              <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar" data-placement="top">
                <i class="fa fa-pencil"></i>
              </a>
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
            <span><strong><i class="fa fa-calendar-times-o"></i> Turno: </strong> {{ $employee->shift->name }}</span><br>
            <span><strong><i class="fa fa-user-secret"></i> Supervisor: </strong> {{ $employee->shift->supervisor->fullName }}</span><br>
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
                  </h4>
                </div>
                <div id="{{$contact->id}}" class="panel-collapse collapse">
                  <div class="panel-body">
                    <dl class="dl-horizontal">
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
              <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#equipments-modal">
                <i class="fa fa-plus-circle" data-toggle="tooltip" title="Agregar Equipo" data-placement="top"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><strong>Equipo</strong></th>
                  <th>Código</th>
                  <th><i class="fa fa-trash"></i></th>
                </tr>
                <tbody>
                  @foreach($employee->equipmentTypes as $equipment)
                  <tr>
                    <td>{{ $equipment->name }}</td>
                    <td>{{ $equipment->code }}</td>
                    <td><a href="{{route('')}}" class="btn btn-danger btn-xs" title="Quitar" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a></td>
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
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><strong>Competencias</strong></th>
                  <th>Código</i></th>
                </tr>
                <tbody>
                  @foreach($employee->courses as $course)
                  <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->code }}</td>
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
      {{ Form::open(['route' => ['employees.equipments.add', $employee->id], 'class' => 'form form-horizontal'])}}
      <div class="modal-body">

        <!-- equipment_type_id -->
        <div class="form-group">
          {{Form::label('equipment_type_id', 'Equipo', ['class' => 'control-label col-md-3',]) }}
          <div class="col-md-6">
            {{Form::select('equipment_type_id', $equipmentTypes, old('equipment_type_id'), ['class' => 'form-control', 'placeholder' => 'Equipo'])}}
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
@endsection
