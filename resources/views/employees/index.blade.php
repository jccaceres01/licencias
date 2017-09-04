@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-1-12">
      <div class="text-center">
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
      </div>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-id-badge"></i> <strong>Lista de empleados <span class="badge">{{ $count }}</span></strong></h3>
        </div>
        <div class="panel-body">
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
              @foreach($employees as $employee)
              <tr>
                <td><img class="img img-responsive img-circle" style="border: solid 2px darkgray;width:35px; height:35px;" src="{{ ($employee->imgpath != null) ? asset($employee->imgpath) : asset('storage/img/page/no-image.png')}}" data-toggle="tooltip" data-placement="top" title="{{ $employee->code }}"></td>
                <td>{{ $employee->code }}</td>
                <td>{{ $employee->identify_document }}</td>
                <td>{{ $employee->firstnames }}</td>
                <td>{{ $employee->lastnames }}</td>
                <td>
                  <a href="{{ route('employees.show', $employee->id )}}" class="btn btn-info btn-xs"> <i class="fa fa-eye"></i></a>
                  <a href="{{ route('employees.edit', $employee->id )}}" class="btn btn-warning btn-xs"> <i class="fa fa-pencil"></i></a>
                  <a href="{{ route('employees.destroy', $employee->id )}}" class="btn btn-danger btn-xs"> <i class="fa fa-remove"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="text-right">
            {{ $employees->appends(Request::except('page'))->render() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
