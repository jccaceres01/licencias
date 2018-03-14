@extends('layouts.main')

@section('head')
<link rel="stylesheet" href="{{ asset('plugins/highcharts/css/highcharts.css')}}">
@endsection
@section('content')
<section class="content-header">
  <h1>
    <i class="fa fa-dashboard"></i>
    Dash Board
    <small>Estadisticas</small>
  </h1>
</section class="content">

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-pie-chart"></i>
              Total de empleados por proyecto
            </h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="container-fluid">
              <div class="">
                {!! $employeesByProjectChart->container() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-pie-chart"></i>
              Estado de Licencias
            </h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="container-fluid">
              <div class="">
                <div class="row">
                  <div class="col-md-6">
                    <div class="small-box bg-gray">
                      <div class="inner">
                        <h3>{{ $endedLicensesCount }}</h3>
                        <p>Licencias Vencidas</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-id-card"></i>
                      </div>
                      <a href="{{ route('employees.licenses.expired')}}" class="small-box-footer">Ver Afectados <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="small-box bg-gray">
                      <div class="inner">
                        <h3>{{ $nextToExpireLicenseCount }}</h3>
                        <p>Proximas Licencias a vencer</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-id-card-o"></i>
                      </div>
                      <a href="{{ route('employees.licenses.soon.expire') }}" class="small-box-footer">Ver Afectados <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
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
<script src="{{ asset('plugins/highcharts/js/highcharts.js')}}" charset="utf-8"></script>
{!! $employeesByProjectChart->script() !!}
@endsection
