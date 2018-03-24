@extends('layouts.main')

@section('head')

<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2-bootstrap.min.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    Lista de Empleados
    <small>Solo empleados activos / Parados </small>
  </h1>
</section>

<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-users"></i> Empleados <span class="badge">{{ App\Employees::activeAndStandBy()->count() }}</span></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
        <div class="btn-group">
          <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-wrench"></i></button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" data-toggle="modal" data-target="#mass_courses_assignament"><i class="fa fa-certificate"></i> Asignacion masiva de Competencias</a></li>
          </ul>
        </div>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <form class="form" action="{{ route('employees.index')}}" method="get">
        <div class="input-group">
          <input type="text" class="form-control" name="criteria" placeholder="Buscar por: Codigo, cedula, nombres o apellidos">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-success">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <br>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th><i class="fa fa-file-picture-o"></i></th>
            <th><i class="fa fa-id-badge"></i> Codigo</th>
            <th><i class="fa fa-id-badge"></i> Cedula</th>
            <th><i class="fa fa-id-badge"></i> Nombres</th>
            <th><i class="fa fa-id-badge"></i> Apellidos</th>
            <th><i class="fa fa-cog"></i> Controles</th>
          </tr>
        </thead>
        <tbody>
          @can('list employees')
          @foreach($employees as $employee)
          <tr>
            <td><img class="img-responsive img-circle" style="border: solid 2px darkgray;width:35px; height:35px;" src="{{ ($employee->imgpath != null) ? asset('storage/'.$employee->imgpath) : asset('storage/img/page/no-image.png')}}" data-toggle="tooltip" data-placement="top" title="{{ $employee->code }}"></td>
            <td>{{ $employee->code }}</td>
            <td>{{ $employee->identity_document }}</td>
            <td>{{ $employee->firstnames }}</td>
            <td>{{ $employee->lastnames }}</td>
            <td>
              @can('view employees')<a href="{{ route('employees.show', $employee->id )}}" class="btn btn-info btn-xs" title="Ver" data-toggle="tooltip" data-placement="top"> <i class="fa fa-eye"></i></a>@endcan
              @can('edit employees')<a href="{{ route('employees.edit', $employee->id )}}" class="btn btn-warning btn-xs" title="Editar" data-toggle="tooltip" data-placement="top"> <i class="fa fa-pencil"></i></a>@endcan
              @can('delete employees')
              {{Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'DELETE', 'class' => 'inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
              <button type="submit" class="btn btn-danger btn-xs" title="Borrar" data-toggle="tooltip" data-placement="top"><i class="fa fa-remove"></i></button>
              {{Form::close()}}
              @endcan
              <div class="dropdown inline">
                <button class="btn dropdown-toggle btn-xs" type="button" name="more-options" data-toggle="dropdown" title="Más" data-toggle="top">
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="">
                  @can('edit employees')<li><a href="{{ route('employees.status.down', $employee->id)}}" onclick="return confirm('¿Desea dar de baja al empleado?')" title="Cancelar empleado" data-toggle="tooltip" data-placement="top"><i class="fa fa-arrow-circle-down"></i> Dar de baja</a></li>@endcan
                </ul>
              </div>
            </td>
          </tr>
          @endforeach
          @endcan
        </tbody>
      </table>
      <div class="text-center">
        {{ $employees->appends(\Request::except('page'))->render() }}
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>

<!-- mass courses assignament -->
<div class="modal fade" id="mass_courses_assignament" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Asignación masiva de competencias</h4>
      </div>
      {{ Form::open(['route' => ['employees.courses.massive.add'], 'class' => 'form form-horizontal', 'files' => true])}}
      <div class="modal-body">

        <!-- employee_id[] -->
        <div class="form-group">
          {{Form::label('employee_id[]', 'Empleados', ['class' => 'control-label col-md-3', 'id'])}}
          <div class="col-md-6">
            <select class="form-control" name="employee_id[]" id="courses_employee_id" style="width:100%" placeholder="Empleados" multiple="multiple">

            </select>
          </div>
        </div>

        <!-- course_id -->
        <div class="form-group">
          {{Form::label('course_id', 'Competencia', ['class' => 'control-label col-md-3']) }}
          <div class="col-md-6">
            <select class="form-control" name="course_id" id="course_id" style="width:100%" placeholder="Competencia">
            </select>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Asignar</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('plugins/axios/axios.min.js')}}" charset="utf-8"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}" charset="utf-8"></script>
<script type="text/javascript">

  /**
   * Fill dialog selects with data
   */
  var courseId = document.getElementById('course_id')
  var coursesEmpId = document.getElementById('courses_employee_id')

  axios.get(document.querySelector('meta[name="url"]').content+'/api/employees')
    .then((res) => {
      res.data.forEach(cb => {
        var opt = document.createElement('option')
        opt.value = cb.id
        opt.text = '('+cb.code+') '+cb.firstnames+' '+cb.lastnames
        coursesEmpId.appendChild(opt)
      })
    }).catch(er => {
      alert(er)
    })

  axios.get(document.querySelector('meta[name="url"]').content+'/api/courses')
    .then((res) => {
    res.data.forEach(cb => {
      var opt = document.createElement('option')
      opt.value = cb.id
      opt.text = '('+cb.code+') '+cb.name
      courseId.appendChild(opt);
    })
  }).catch(er => {
    alert(er)
  })

  /**
   * INitialize tooltips for dropdown values in options menu
   */
  $('button[name="more-options"]').tooltip();
  /**
   * Initialize select2 for select fields
   */
  $('#courses_employee_id').select2({
    theme: 'bootstrap',
    dropdownParent: $('#mass_courses_assignament')
  })

  $('#course_id').select2({
    theme: 'bootstrap',
    dropdownParent: $('#mass_courses_assignament')
  })

</script>
@endsection
