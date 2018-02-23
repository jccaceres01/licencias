@extends ('layouts.main')

@section('head')
<meta name="latitude" content="{{$project->latitude }}">
<meta name="longitude" content="{{ $project->longitude }}">
<meta name="altitude" content="{{ $project->altitude }}">

<style>
  #map {
    height: 300px;
    width: 100%;
    margin: 3px 0px 3px 0px;
   }
</style>

@endsection

@section('content')
<section class="content-header">
  <h1>
    Proyecto
    <small>{{ $project->name }}</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-university"></i>
              Proyecto: {{ $project->name }}
            </h3>
            <div class="pull-right">
              @can('edit projects')<a href="{{ route('projects.edit', $project->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>@endcan
              @can('delete projects')
              {{Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'DELETE', 'class' => 'form inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
              <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Borrar" data-placement="top">
                <i class="fa fa-close"></i>
              </button>
              {{ Form::close() }}
              @endcan
            </div>
          </div>
          <div class="box-centent">
            <div class="container-fluid">
              <div class="col-md-12">
                <span><strong><i class="fa fa-university"></i> Proyecto: </strong> {{ $project->name }}</span><br>
                <span><strong><i class="fa fa-globe"></i> País: </strong> {{ ($project->country != null) ? $project->country->name : 'No definido'}}</span><br>
                <span><strong><i class="fa fa-file-text-o"></i> Descripción: </strong> {{ $project->description }}</span><br>
                <span><strong><i class="fa fa-road"></i> Dirección: </strong> {{ $project->address }}</span><br>
                <span><strong><i class="fa fa-envelope-o"></i> Correo Electronico: </strong> {{ $project->email }}</span><br>
                <span><strong><i class="fa fa-user-secret"></i> Supervisor General: </strong> {{ ($project->generalSupervisor != null) ? $project->generalSupervisor->fullName : 'No definido' }}</span><br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-map"></i>
              Localización
            </h3>
          </div>
          <div class="box-centent">
            <div class="container-fluid">
              <div class="col-md-12">
                <div id="map"></div>
                <hr>
                <span><strong><i class="fa fa-map-marker"></i> Latitud: </strong> {{ $project->latitude }}</span><br>
                <span><strong><i class="fa fa-map-marker"></i> Longitud: </strong> {{ $project->longitude }}</span><br>
                <br>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCym39eienlEA3T19C0-bs0aDoZQdPlQn0&callback=initMap"></script>
<script type="text/javascript">

  var mLat = document.querySelector('meta[name="latitude"]').getAttribute('content')
  var mLong = document.querySelector('meta[name="longitude"]').getAttribute('content')

  function initMap() {

    var initPos = {lat: parseFloat(mLat), lng: parseFloat(mLong)};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: initPos // 47.619986, -131.390732
    });

    var marker = new google.maps.Marker({
      position: initPos,
      draggable: false,
      title: 'Ubicación Proyecto',
      map: map
    });
  }

  $("#markerdt").on("shown.bs.modal", function () {
    google.maps.event.trigger(map, "resize");
  });
</script>
@endsection
