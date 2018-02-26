@extends('layouts.main')

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
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
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
              @can('view employees')<a href="{{ route('employees.show', $employee->id )}}" class="btn btn-info btn-xs"> <i class="fa fa-eye"></i></a>@endcan
              @can('edit employees')<a href="{{ route('employees.edit', $employee->id )}}" class="btn btn-warning btn-xs"> <i class="fa fa-pencil"></i></a>@endcan
              @can('delete employees')
              {{Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'DELETE', 'class' => 'inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
              <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
              {{Form::close()}}
              @endcan
              <div class="dropdown inline">
                <button class="btn dropdown-toggle btn-xs" type="button" id="" data-toggle="dropdown">
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="">
                  @can('edit employees')<li><a href="{{ route('employees.status.down', $employee->id)}}" onclick="return confirm('¿Desea dar de baja al empleado?')"><i class="fa fa-arrow-circle-down"></i> Dar de baja</a></li>@endcan
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
@endsection
