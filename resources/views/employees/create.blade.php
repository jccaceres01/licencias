@extends('layouts.main')

@section('head')
<meta name="no-image" content="{{ asset('storage/img/page/no-image.png')}}">
<style media="screen">
  #imgpath {
    display: none;
  }

  #prev {
    margin: 12px;
    border: solid 5px #d2d6de;
    border-radius: 100%;
    width: 130px;
    height: 130px;
  }

</style>
@endsection

@section('content')
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>
    Empleado
    <small>Creando uno nuevo</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        {{ Form::open(['route' => 'employees.store', 'class' => 'form', 'files' => true]) }}
          <div class="box">
            <div class="box-header with-border">
              <h1 class="box-title"><i class="fa fa-users"></i> Nuevo Empleado</h1>
            </div>
            <div class="box-body">
              @if ($errors->count() > 0)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach($errors->all() as $er)
                <p>* {{ $er }}</p>
                @endforeach
              </div>
              @endif
              <h3>Información de proyecto</h3>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <!-- project_id -->
                  <div class="form-group">
                    {{ Form::label('project_id', 'Proyecto *')}}
                    {{ Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control', 'placeholder' => 'Proyecto'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- code -->
                  <div class="form-group">
                    {{ Form::label('code', 'Código *')}}
                    {{ Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => 'Código'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- position -->
                  <div class="form-group">
                    {{ Form::label('position', 'Posición')}}
                    {{ Form::text('position', old('position'), ['class' => 'form-control', 'placeholder' => 'Posición'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <!-- employee_type -->
                  <div class="form-group">
                    {{ Form::label('employee_type', 'Tipo de Empleado')}}
                    <select class="form-control" name="employee_type">
                      <option value="" disabled selected>Tipo de Empleado</option>
                      @foreach(array_sort(App\Employees::$employeeType) as $employeeType)
                      @if($employeeType == old('employee_type'))
                      <option value="{{ $employeeType }}" selected>{{ title_case($employeeType) }}</option>
                      @else
                      <option value="{{ $employeeType }}">{{ title_case($employeeType) }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- shift_id -->
                  <div class="form-group">
                    {{ Form::label('shift_id', 'Turno')}}
                    {{ Form::select('shift_id',  $shifts, old('shift_id'), ['class' => 'form-control', 'placeholder' => 'Turnos'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- hiredate -->
                  <div class="form-group">
                    {{ Form::label('hiredate', 'Fecha de Contratación')}}
                    {{ Form::date('hiredate', old('hiredate'), ['class' => 'form-control', 'placeholder' => 'Fecha de Contratación'])}}
                  </div>
                </div>
              </div>
              <h3>Información Personal</h3>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <!-- imgpath -->
                  <div class="form-group">
                    <img src="{{ asset('storage/img/page/no-image.png')}}" id="prev"><br>
                    <label for="imgpath" class="btn btn-default"><i class="fa fa-picture-o"></i> Seleccionar Imagen</label>
                    {{ Form::file('imgpath', ['placeholder' => 'Foto', 'id' => 'imgpath', 'accept' => 'image/*'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <!-- firstnames -->
                  <div class="form-group">
                    {{ Form::label('firstnames', 'Nombres *')}}
                    {{ Form::text('firstnames', old('firstnames'), ['class' => 'form-control', 'placeholder' => 'Nombres'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- lastnames -->
                  <div class="form-group">
                    {{ Form::label('lastnames', 'Apellidos *')}}
                    {{ Form::text('lastnames', old('lastnames'), ['class' => 'form-control', 'placeholder' => 'Apellidos'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- nickname -->
                  <div class="form-group">
                    {{ Form::label('nickname', 'Apodo')}}
                    {{ Form::text('nickname', old('nickname'), ['class' => 'form-control', 'placeholder' => 'Apodo'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <!-- country_id -->
                  <div class="form-group">
                    {{ Form::label('country_id', 'Nacionalidad')}}
                    {{ Form::select('country_id',  App\Countries::orderBy('name')->pluck('name', 'id'), old('country_id'), ['class' => 'form-control', 'placeholder' => 'Nacionalidad'])}}
                  </div>
                </div>
                <div class="col-md-3">
                  <!-- identify_document -->
                  <div class="form-group">
                    {{ Form::label('identify_document', 'Cedula *')}}
                    {{ Form::text('identify_document', old('identify_document'), ['class' => 'form-control', 'placeholder' => 'Cedula'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <!-- gender -->
                  <div class="form-group">
                    {{ Form::label('gender', 'Genero')}}
                    <select class="form-control" name="gender">
                      <option value="" disabled selected>Genero</option>
                      @foreach(App\Employees::$gender as $gender)
                      @if($gender == old('gender'))
                      <option value="{{ $gender }}" selected>{{ $gender }}</option>
                      @else
                      <option value="{{ $gender }}">{{ $gender }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <!-- blood -->
                  <div class="form-group">
                    {{ Form::label('blood', 'Tipo de Sangre')}}
                    <select class="form-control" name="blood">
                      <option value="" selected disabled>Tipo de Sangre</option>
                      @foreach(array_sort(App\Employees::$blood) as $blood)
                      @if($blood == old('blood', null))
                      <option value="{{ $blood }}" selected>{{ $blood }}</option>
                      @else
                      <option value="{{ $blood }}"> {{ $blood }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <!-- birthdate -->
                  <div class="form-group">
                    {{ Form::label('birthdate', 'Fecha de Nacimiento')}}
                    {{ Form::date('birthdate', old('birthdate'), ['class' => 'form-control', 'placeholder' => 'Fecha de Nacimiento'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <!-- phonenumber -->
                  <div class="form-group">
                    {{ Form::label('phonenumber', 'Telefono')}}
                    {{ Form::text('phonenumber', old('phonenumber'), ['class' => 'form-control', 'placeholder' => 'Telefono'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- cellphone -->
                  <div class="form-group">
                    {{ Form::label('cellphone', 'Celular')}}
                    {{ Form::text('cellphone', old('cellphone'), ['class' => 'form-control', 'placeholder' => 'Celular'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- email -->
                  <div class="form-group">
                    {{ Form::label('email', 'Correo Electronico')}}
                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Electronico'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <!-- address -->
                  <div class="form-group">
                    {{ Form::label('address', 'Dirección')}}
                    {{ Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Dirección'])}}
                  </div>
                </div>
              </div>
              <h3>Información de Licencia</h3>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <!-- drive_license -->
                  <div class="form-group">
                    {{ Form::label('drive_license', 'Licencia de Conducir')}}
                    {{ Form::text('drive_license', old('drive_license'), ['class' => 'form-control', 'placeholder' => 'Licencia de Conducir'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- drive_license_category -->
                  <div class="form-group">
                    {{ Form::label('drive_license_category', 'Categoria de Licencia')}}
                    <select class="form-control" name="drive_license_category">
                      <option value="" disabled selected>Categoria de Licencia</option>
                      @foreach(App\Employees::$driveLicenseCategory as $category)
                      @if($category == old('drive_license_category', null))
                      <option value="{{ $category }}" selected>{{ $category }}</option>
                      @else
                      <option value="{{ $category }}">{{ $category }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- drive_license_restriction -->
                  <div class="form-group">
                    {{ Form::label('drive_license_restriction', 'Restricción de Licencia')}}
                    {{ Form::text('drive_license_restriction', old('drive_license_restriction'), ['class' => 'form-control', 'placeholder' => 'Restricción de Licencia'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <!-- drive_license_start -->
                  <div class="form-group">
                    {{ Form::label('drive_license_start', 'Fecha de Emisión')}}
                    {{ Form::date('drive_license_start', old('drive_license_start'), ['class' => 'form-control', 'placeholder' => 'Fecha de Emisión'])}}
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- drive_license_end -->
                  <div class="form-group">
                    {{ Form::label('drive_license_end', 'Fecha de Vencimiento')}}
                    {{ Form::date('drive_license_end', old('drive_license_end'), ['class' => 'form-control', 'placeholder' => 'Fecha de Vencimiento'])}}
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="pull-right">
                <button type="reset" class="btn btn-default" onClick="clearImage()"><i class="fa fa-trash"></i> Limpiar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"> Guardar y continuar</i></button>
              </div>
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
  var prev = document.getElementById('prev')
  var input = document.getElementById('imgpath')


  input.onchange = function() {
    var reader = new FileReader();
    reader.onload = function(e) {
      prev.src = e.target.result
    }

    reader.readAsDataURL(this.files[0])
  }

  function clearImage() {
    prev.src = document.querySelector('meta[name="no-image"]').content
  }
</script>
@endsection
