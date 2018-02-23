@extends ('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Grupos
    <small>Nuevo Grupo</small>
  </h1>
</section>

<section class="content">
<div class="container-fluid">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">
          <i class="fa fa-calendar-times-o"></i>
          Agregar Grupo
        </h3>
      </div>
      <div class="box-content">
        <div class="container-fluid">
          <div class="row">
            <br>
            @if($errors->count() != 0)
            <div class="alert alert-danger alert-dismissible" style="margin: 12px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              @foreach($errors->all() as $e)
              <p>* {{ $e }}</p>
              @endforeach
            </div>
            @endif
            <div class="col-md-6">
              {{ Form::open(['route' => 'groups.store', 'class' => 'form', 'class' => 'form form-horizontal']) }}

              <!-- name -->
              <div class="form-group">
                {{ Form::label('name', 'Nombre', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nombre'])}}
                </div>
              </div>

              <!-- employee_id -->
              <div class="form-group">
                {{ Form::label('employee_id', 'Supervisor de Grupo', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  <select class="form-control" name="employee_id">
                    <option selected dissabled="disabled" value="">Supervisor de Grupo</option>
                    @foreach($supervisors as $supervisor)
                    @if($supervisor->id == old('employee_id'))
                    <option value="{{ $supervisor->id}}" selected> {{ $supervisor->fullName }}</option>
                    @else
                    <option value="{{ $supervisor->id}}"> {{ $supervisor->fullName }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <!-- project_id -->
              <div class="form-group">
                {{ Form::label('project_id', 'Proyecto', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control', 'placeholder' => 'Proyecto'])}}
                </div>
              </div>

              <!-- Form control -->
              <div class="form-group">
                {{ Form::label('', '', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  <button type="reset" class="btn btn-warning">
                    Limpiar
                    <i class="fa fa-trash"></i>
                  </button>
                  <button type="submit" class="btn btn-success">
                    Crear
                    <i class="fa fa-floppy-o"></i>
                  </button>
                </div>
              </div>

              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection

@section('script')
@endsection
