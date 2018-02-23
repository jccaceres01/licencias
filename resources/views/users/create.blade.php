@extends ('layouts.main')

@section('head')
  <meta name="no-image" content="{{ asset('storage/img/page/no-image.png')}}">
  <style>
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
    Usuarios
    <small>Nuevo Usuario</small>
  </h1>
</section>

<section class="content">
<div class="container-fluid">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">
          <i class="fa fa-user"></i>
          Agregar Usuario
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
            <div class="col-md-12">
              {{ Form::open(['route' => 'users.store', 'class' => 'form', 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) }}

              <!-- imgpath -->
              <div class="form-group text-center">
                <img src="{{ asset('storage/img/page/no-image.png')}}" id="prev"><br>
                <label for="imgpath" class="btn btn-default"><i class="fa fa-picture-o"></i> Seleccionar Imagen</label>
                {{ Form::file('imgpath', ['placeholder' => 'Foto', 'id' => 'imgpath', 'accept' => 'image/*'])}}
              </div>

              <!-- name -->
              <div class="form-group">
                {{ Form::label('name', 'Nombre Usuario *', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nombre Completo'])}}
                </div>
              </div>

              <!-- email -->
              <div class="form-group">
                {{ Form::label('email', 'Correo Electronico *', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Electronico'])}}
                </div>
              </div>

              <!-- password -->
              <div class="form-group">
                {{ Form::label('password', 'Contraseña *', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña'])}}
                </div>
              </div>

              <!-- repassword -->
              <div class="form-group">
                {{ Form::label('repassword', 'Repetir Contraseña *', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::password('repassword', ['class' => 'form-control', 'placeholder' => 'Repetir Contraseña'])}}
                </div>
              </div>

              <!-- Form control -->
              <div class="form-group">
                {{ Form::label('', '', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  <button type="reset" class="btn btn-warning" onClick="clearImage()">
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
<div class="modal fade" id="markerdt" tabindex="1000" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Arrastrar y soltar el marcador hasta la zona deseada</h4>
      </div>
      <div class="modal-body">
        <div id="map"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
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
