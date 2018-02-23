@extends ('layouts.main')

@section('head')
  <style>
    #map {
      height: 400px;
      width: 100%;
     }
  </style>
@endsection


@section('content')
<section class="content-header">
  <h1>
    Proyectos
    <small>Nuevo Proyecto</small>
  </h1>
</section>

<section class="content">
<div class="container-fluid">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">
          <i class="fa fa-university"></i>
          Agregar Proyecto
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
              {{ Form::open(['route' => 'projects.store', 'class' => 'form', 'class' => 'form form-horizontal']) }}

              <!-- name -->
              <div class="form-group">
                {{ Form::label('name', 'Nombre Proyecto *', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nombre'])}}
                </div>
              </div>

              <!-- country_id -->
              <div class="form-group">
                {{ Form::label('country_id', 'País *', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-6">
                  {{ Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control', 'placeholder' => 'País'])}}
                </div>
              </div>

              <!-- description -->
              <div class="form-group">
                {{ Form::label('description', 'Descripción', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-8">
                  {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Descripción'])}}
                </div>
              </div>

              <!-- address -->
              <div class="form-group">
                {{ Form::label('address', 'Dirección', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-8">
                  {{ Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Dirección'])}}
                </div>
              </div>

              <!-- employee_id -->
              <div class="form-group">
                {{ Form::label('employee_id', 'Supervisor General', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-7">
                  <select class="form-control" name="employee_id">
                    <option value="" selected disabled>Supervisor General</option>
                    @foreach($generalSupervisor as $gSup)
                    @if ($gSup->id == old('employee_id'))
                    <option value="{{ $gSup->id }}" selected>{{ $gSup->fullName }}</option>
                    @else
                    <option value="{{ $gSup->id }}">{{ $gSup->fullName }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>

              <!-- email -->
              <div class="form-group">
                {{ Form::label('email', 'Correo Electronico', ['class' => 'control-label col-md-3'])}}
                <div class="col-md-8">
                  {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Electronico del Proyecto'])}}
                </div>
              </div>

              <!-- Location info -->
              <div class="well well-sm">
                <!-- latitude -->
                <div class="form-group">
                  {{ Form::label('latitude', 'Latitud', ['class' => 'control-label col-md-3'])}}
                  <div class="col-md-8">
                    {{ Form::number('latitude', old('latitude'), ['class' => 'form-control', 'placeholder' => 'Latitud', 'step' => '0.00000001'])}}
                  </div>
                </div>

                <!-- longitude -->
                <div class="form-group">
                  {{ Form::label('longitude', 'Longitud', ['class' => 'control-label col-md-3'])}}
                  <div class="col-md-8">
                    {{ Form::number('longitude', old('longitude'), ['class' => 'form-control', 'placeholder' => 'Longitud', 'step' => '0.00000001'])}}
                  </div>
                </div>

                <!-- map marker button -->
                <div class="form-group">
                  {{ Form::label('', '', ['class' => 'control-label col-md-3'])}}
                  <div class="col-md-8">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#markerdt">
                      <i class="fa fa-map-marker"></i>
                    </button>
                  </div>
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
                    Guardar
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCym39eienlEA3T19C0-bs0aDoZQdPlQn0&callback=initMap"></script>
<script type="text/javascript">

  function initMap() {

    var initPos = {lat: 18.896443, lng: -75.451212};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 2,
      center: {lat: 47.619986, lng: -131.390732} // 47.619986, -131.390732
    });

    var marker = new google.maps.Marker({
      position: initPos,
      draggable: true,
      title: 'Seleccione una hubicación',
      map: map
    });


    google.maps.event.addListener(marker, 'dragend', function(callback){
      document.getElementById('latitude').value = callback.latLng.lat().toFixed(8)
      document.getElementById('longitude').value = callback.latLng.lng().toFixed(8)
    });
  }

  $("#markerdt").on("shown.bs.modal", function () {
    google.maps.event.trigger(map, "resize");
  });
</script>
@endsection
