@extends ('layouts.main')

@section('content')
<section class="header">
  <section class="content-header">
    <h1>
      Editar Contacto
      <small>{{ $contact->fullName }}</small>
    </h1>
  </section>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
            <i class="fa fa-pencil"></i>
            Editar Contacto <small>{{ $contact->fullName }}</small>
          </h3>
        </div>
        <div class="box-content">
          <div class="container-fluid">
            @if ($errors->count() > 0)
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              @foreach($errors->all() as $e)
              <p>* {{ $e }}</p>
              @endforeach
            </div>
            @endif
          </div>
          {{ Form::model($contact, ['route' => ['contacts.update', $contact->id], 'method' => 'PUT', 'class' => 'form form-horizontal'])}}
          <div class="modal-body">

            <!-- firstnames -->
            <div class="form-group">
              {{Form::label('firstnames', 'Nombres', ['class' => 'control-label col-md-3']) }}
              <div class="col-md-6">
                {{Form::text('firstnames', old('firstnames'), ['class' => 'form-control', 'placeholder' => 'Nombres'])}}
              </div>
            </div>

            <!-- lastnames -->
            <div class="form-group">
              {{Form::label('lastnames', 'Apellidos', ['class' => 'control-label col-md-3']) }}
              <div class="col-md-6">
                {{Form::text('lastnames', old('lastnames'), ['class' => 'form-control', 'placeholder' => 'Apellidos'])}}
              </div>
            </div>

            <!-- email -->
            <div class="form-group">
              {{Form::label('email', 'Correo Electronico', ['class' => 'control-label col-md-3']) }}
              <div class="col-md-6">
                {{Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Electronico'])}}
              </div>
            </div>

            <!-- phone -->
            <div class="form-group">
              {{Form::label('phone', 'Telefono', ['class' => 'control-label col-md-3']) }}
              <div class="col-md-6">
                {{Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Telefono'])}}
              </div>
            </div>

            <!-- cell -->
            <div class="form-group">
              {{Form::label('cell', 'Celular', ['class' => 'control-label col-md-3']) }}
              <div class="col-md-6">
                {{Form::text('cell', old('cell'), ['class' => 'form-control', 'placeholder' => 'Celular'])}}
              </div>
            </div>

            <!-- address -->
            <div class="form-group">
              {{Form::label('address', 'Dirección', ['class' => 'control-label col-md-3']) }}
              <div class="col-md-6">
                {{Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Dirección'])}}
              </div>
            </div>

            <!-- relation -->
            <div class="form-group">
              {{Form::label('address', 'Relación', ['class' => 'control-label col-md-3']) }}
              <div class="col-md-6">
                <select class="form-control" name="relation">
                  <option value=""selected disabled>Relación</option>
                  @foreach(array_sort(App\Contacts::$relation) as $relation)
                  @if($relation == $contact->relation)
                  <option value="{{ $relation}}" selected>{{ $relation }}</option>
                  @else
                  <option value="{{ $relation}}">{{ $relation }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>

            <!-- employee_id -->
            {{ Form::hidden('employee_id', $contact->employee->id)}}

          </div>

          <div class="box-footer">
            <div class="pull-right">
              <button type="reset" class="btn btn-default" data-dismiss="modal">
                <i class="fa fa-refresh"></i>
                Restablecer
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                Actualizar
              </button>
            </div>
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
