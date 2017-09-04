@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="fa fa-id-badge"></i>
            <strong>Informaci&oacute;n Empleado</strong>
            <div class="pull-right">
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
          </h3>
        </div>
        <div class="panel-body">
          <img src="{{ ($employee->imgpath != null) ? asset('storage/'.$employee->imgpath) : asset('storage/img/page/no-image.png')}}" alt="" class="img img-responsive img-thumbnail" style="width: 120px; height: 120px">
          <br>
          <span><strong><i class="fa fa-tasks"></i> Proyecto: </strong> {{ $employee->project->name }}</span><br>
          <span><strong><i class="fa fa-flag"></i> Nacionalidad: </strong> {{ $employee->country->name }}</span><br>
          <span><strong><i class="fa fa-id-card"></i> Codigo: </strong> {{ $employee->code }}</span><br>
          <span><strong><i class="fa fa-id-card-o"></i> Cedula: </strong> {{ $employee->identify_document }}</span><br>
          <span><strong><i class="fa fa-user-circle"></i> Nombres: </strong> {{ $employee->firstnames }}</span><br>
          <span><strong><i class="fa fa-user-circle"></i> Apellidos: </strong> {{ $employee->lastnames }}</span><br>
          <span><strong><i class="fa fa-user-circle"></i> Apodo: </strong> {{ $employee->nickname }}</span><br>
          <span><strong><i class="fa fa-calendar"></i> Fecha de Nacimiento: </strong> {{ $employee->latamBirthdate }}</span><br>
          <span><strong><i class="fa fa-calendar"></i> Fecha de Contrataci&oacute;n: </strong> {{ $employee->latamHiredate }}</span><br>
          <span><strong><i class="fa fa-heart"></i> Tipo de Sangre: </strong> {{ $employee->blood }}</span><br>
          <span><strong><i class="fa fa-tag"></i> Posici&oacute;n: </strong> {{ $employee->position }}</span><br>
          <span><strong><i class="fa fa-envelope"></i> Email: </strong> {{ $employee->email }}</span><br>
          <span><strong><i class="fa fa-phone"></i> Tel&eacute;fono: </strong> {{ $employee->phonenumber }}</span><br>
          <span><strong><i class="fa fa-mobile-phone"></i> Celular: </strong> {{ $employee->cellphone }}</span><br>
          <span><strong><i class="fa fa-map-marker"></i> Direcci&oacute;n: </strong> {{ $employee->address }}</span><br>
        </div>
        <div class="panel-footer">

        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-address-book"></i> <strong>Contactos y Emergencias </strong></h3>
        </div>
        <div class="panel-body">
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
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="fa fa-truck"></i>
            <strong>Informaci&oacute;n Operativa</strong>
          </h3>
        </div>
        <div class="panel-body">
          <!-- Drive license info -->
          <h3>Licencia de conducir</h3>
          <hr>
          <span><strong><i class="fa fa-drivers-license"></i> No. Licencia: </strong> {{ $employee->drive_license }}</span><br>
          <span><strong><i class="fa fa-calendar"></i> Fecha de Emisi&oacute;n: </strong> {{ $employee->latamDriveLicenseStart }}</span><br>
          <span><strong><i class="fa fa-calendar"></i> Fecha de Vencimiento: </strong> {{ $employee->latamDriveLicenseEnd }}</span><br>
          <span><strong><i class="fa fa-tags"></i> Categoria: </strong> {{ $employee->drive_license_category }}</span><br>
          <span><strong><i class="fa fa-warning"></i> Restrici&oacute;n de Licencia: </strong> {{ $employee->drive_license_restriction }}</span><br>

          <!-- Employee's equipments types of kind equipo -->
          <h3>Equipos: </h3>
          <hr>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th colspan="2" class="text-center">Capacitado y autorizado para operar</th>
              </tr>
              <tr>
                <th><strong>Equipo</strong></th>
                <th><i class="fa fa-file-image-o"></i></th>
              </tr>
              <tbody>
                @foreach($employee->equipmentTypes as $equipment)
                @if($equipment->classification == 'equipo')
                <tr>
                  <td><strong>{{ $equipment->name }}</strong></td>
                  <td><img src="{{ asset('storage/'.$equipment->imgpath) }}" class="img img-responsive img-thumbnail" style="width: 40px; height: 40px"></td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </thead>
          </table>
          <h3>Herramientas: </h3>
          <hr>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th colspan="2" class="text-center">Capacitado y autorizado para manejar</th>
              </tr>
              <tr>
                <th><strong>Herramienta</strong></th>
                <th><i class="fa fa-file-image-o"></i></th>
              </tr>
              <tbody>
                @foreach($employee->equipmentTypes as $equipment)
                @if($equipment->classification == 'herramienta')
                <tr>
                  <td><strong>{{ $equipment->name }}</strong></td>
                  <td><img src="{{ asset('storage/'.$equipment->imgpath) }}" class="img img-responsive img-thumbnail" style="width: 40px; height: 40px"></td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </thead>
          </table>
        </div>
        <div class="panel-footer">

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
