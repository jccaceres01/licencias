@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Reportes
    <small>reportes de impresión</small>
  </h1>
</section>

<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-file-word-o"></i> Reportes</h3>
    </div>
    <div class="box-body">
      <div class="container-fluid">
        @can('view reports')
        <div class="row">
          <div class="col-md-4">
            <h3>Empleados</h3>
            <hr>
            <ul>
              <li><a href="#">Listado de empleados</a></li>
              <li><a href="#" data-toggle="modal" data-target="#employees_equipments">Equipos autorizados por empleados</a></li>
            </ul>
          </div>
          <div class="col-md-4">

          </div>
          <div class="col-md-4">

          </div>
        </div>
        @else
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center">No tiene privilegios para ver reportes</h1>
          </div>
        </div>
        @endcan
      </div>
    </div>
  </div>
  <!-- /.box -->
</section>

<!-- Reports dialogs for parameters -->
<!-- employees equipments report -->
<div class="modal fade" id="employees_equipments" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id=""></h4>
      </div>
      {{Form::open(['route' => 'reports.employees.equipments', 'method' => 'GET', 'target' => '_new'])}}
      <div class="modal-body">
        <div class="form-group">
          <label for="">Proyecto</label>
          {{ Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control', 'required', 'placeholder' => 'Proyecto'])}}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Ver <i class="fa fa-eye"></i></button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection
