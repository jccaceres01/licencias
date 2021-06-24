@extends('layouts.main')

@section('head')
<meta name="no-image" content="{{ ($employee->imgpath != null ) ? asset('storage/'.$employee->imgpath) : asset('storage/img/page/no-image.png')}}">

<!-- select2 styles and theme -->
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2-bootstrap.min.css')}}">

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
    <i class="fa fa-plus-pencil"></i>
    Editar Empleado
    <small>{{ $employee->fullName }}</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        {{ Form::model($employee, ['route' => ['employees.update', $employee->id], 'method' => 'PUT', 'class' => 'form', 'files' => true]) }}
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
              <!-- employee_id -->
              {{Form::hidden('id', $employee->id) }}
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
                    {{ Form::label('employee_type', 'Tipo de Empleado *')}}
                    <select class="form-control" name="employee_type">
                      <option value="" disabled selected>Tipo de Empleado</option>
                      @foreach(array_sort(App\Models\Employees::$employeeType) as $employeeType)
                      @if($employeeType == $employee->employee_type)
                      <option value="{{ $employeeType }}" selected>{{ title_case($employeeType) }}</option>
                      @else
                      <option value="{{ $employeeType }}">{{ title_case($employeeType) }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- group_id -->
                  <div class="form-group">
                    {{ Form::label('group_id', 'Grupo')}}
                    {{ Form::select('group_id',  $groups, old('group_id'), ['class' => 'form-control', 'placeholder' => 'Grupos'])}}
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
                    <img src="{{ ($employee->imgpath != null) ? asset('storage/'.$employee->imgpath) : asset('storage/img/page/no-image.png')}}" id="prev"><br>
                    <label for="imgpath" class="btn btn-default"><i class="fa fa-picture-o"></i> Seleccionar Imagen</label>
                    {{ Form::file('imgpath', ['placeholder' => 'Foto', 'id' => 'imgpath', 'accept' => 'image/*'])}}
                    <br>
                    <span style="color:red">Dejar imagen intacta si no desea actualizarla</span>
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
                    {{ Form::select('country_id',  App\Models\Countries::orderBy('name')->pluck('name', 'id'), old('country_id'), ['class' => 'form-control', 'placeholder' => 'Nacionalidad'])}}
                  </div>
                </div>
                <div class="col-md-3">
                  <!-- identity_document -->
                  <div class="form-group">
                    {{ Form::label('identity_document', 'Cedula *')}}
                    {{ Form::text('identity_document', old('identity_document'), ['class' => 'form-control', 'placeholder' => 'Cedula'])}}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <!-- gender -->
                  <div class="form-group">
                    {{ Form::label('gender', 'Genero')}}
                    <select class="form-control" name="gender" placeholder="Género">
                      <option value="">Género</option>
                      @foreach(App\Models\Employees::$gender as $gender)
                      @if($employee->gender == $gender)
                      <option value="{{ $gender }}" selected="selected">{{ $gender}}</option>
                      @else
                      <option value="{{ $gender }}"> {{ $gender }}</option>
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
                      <option value="">Tipo de Sangre</option>
                      @foreach(App\Models\Employees::$blood as $blood)
                      @if ($employee->blood == $blood)
                      <option value="{{ $blood }}" selected="selected"> {{ $blood }}</option>
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
                      @foreach(App\Models\Employees::$driveLicenseCategory as $category)
                      @if($category == $employee->drive_license_category)
                      <option value="{{ $category }}" selected="selected">{{ $category }}</option>
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
                <button type="reset" class="btn btn-default" onClick="clearImage()"><i class="fa fa-trash"></i> Restablecer</button>
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
<!-- select2 library  -->
<script src="{{ asset('plugins/select2/select2.min.js') }}" charset="utf-8"></script>
<script type="text/javascript">
/**
 * Initialize select2 fields
 */
$('#project_id').select2({theme: 'bootstrap'})
$('select[name="employee_type"]').select2({theme: 'bootstrap'})
$('#group_id').select2({theme: 'bootstrap'})
$('select[name="blood"]').select2({theme: 'bootstrap'})
$('#country_id').select2({theme: 'bootstrap'})
$('select[name="gender"]').select2({theme: 'bootstrap'})
$('select[name="drive_license_category"]').select2({theme: 'bootstrap'})

/**
 * Image Api code for preview image
 */
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
