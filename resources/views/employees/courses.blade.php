@extends('layouts.main')

@section('content')

<!-- content header -->
<section class="content-header">
  <h1>
    Competencias del empleado:
    <small>{{ $employee->fullName }}</small>
  </h1>
  <br>
</section>

<!-- Errors show -->
<div class="container-fluid">
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
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Editar competencias del empleado <small>{{ $employee->fullName }}</small> </h3>
          </div>
          <div class="box-body">
            <h5><strong> Competencia: </strong> {{ $course->name }} </h5>
            <h5><strong>Código: </strong> {{ $course->code }} </h5>
            <hr>
            {{ Form::open(['route' => ['employees.courses.update', $employee->id, $course->id], 'method' => 'put', 'class' => 'form form-horizontal', 'files' => true])}}
              <!-- date -->
              <div class="form-group">
                {{ Form::label('date', 'Fecha *', ['class' => 'col-md-3 control-label'])}}
                <div class="col-md-6">
                  {{ Form::date('date', $employee->courses()->find($course->id)->pivot->date, ['class' => 'form-control', 'placeholder' => 'Fecha'])}}
                </div>
              </div>

              <!-- filepath -->
              <div class="form-group">
                {{ Form::label('filepath', 'Documento', ['class' => 'col-md-3 control-label'])}}
                <div class="col-md-6">
                  {{ Form::file('filepath')}}
                  <p style="color:red">No seleccionar archivo si se quiere dejar el antiguo intacto</p>
                </div>
              </div>

              <!-- carnet_print -->
              <div class="form-group">
                {{Form::label('carnet_print', 'Imprimir en Carnet', ['class' => 'control-label col-md-3']) }}
                <div class="col-md-6">
                  @if ($employee->courses()->find($course->id)->pivot->carnet_print == true)
                  {{ Form::hidden('carnet_print', 0)}}
                  {{Form::checkbox('carnet_print', 1, true)}}
                  @else
                  {{ Form::hidden('carnet_print', 0)}}
                  {{Form::checkbox('carnet_print', 1, false)}}
                  @endif
                </div>
              </div>

              <!-- contols -->
              <div class="form-group">
                <label for="" class="col-md-3 control-label"></label>
                <div class="col-md-6">
                  <button type="button" class="btn btn-warning" onclick="window.history.back()">
                    <i class="fa fa-arrow-left"></i>
                    Cancelar
                  </button>
                  <button type="submit" class="btn btn-primary">
                    Modificar
                    <i class="fa fa-save"></i>
                  </button>
                </div>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
