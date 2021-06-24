@extends('layouts.main')

@section('head')
<meta name="no-image" content="{{ asset('storage/img/page/no-image.png')}}">
<!-- select2 css stylesheet -->
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2-bootstrap.min.css')}}">
@endsection

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
              <li><a href="#" data-toggle="modal" data-target="#epd_employees_projects_dialog">Empleados por Proyectos</a></li>
              <li><a href="#" data-toggle="modal" data-target="#employees_groups_dialog">Empleados por Grupos</a></li>
              <li><a href="#" target="_new">Empleados Cancelados</a></li>
              <li><a href="#" data-toggle="modal" data-target="#employees_equipments">Empleados / Equipos autorizados por grupo</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h3>Licencias</h3>
            <hr>
            <ul>
              <li><a href="#" target="_new">Estado de licencias</a></li>
            </ul>
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
        <h4 class="modal-title" id="">Empleados con equipos autorizados</h4>
      </div>
      {{Form::open(['method' => 'GET', 'target' => '_new'])}}
      <div class="modal-body">
        <div class="form-group">
          <label for="">Proyecto</label>
          {{ Form::select('ee_project_id', $projects, old('ee_project_id'), ['class' => 'form-control', 'required', 'placeholder' => 'Proyecto', 'style' => 'width:100%', 'id' => 'ee_project_id'])}}
        </div>
        <div class="form-group">
          <label for="ee_group_id"></label>
          <select class="form-group" name="ee_group_id">
            <option value="" selected disabled>Grupo</option>
          </select>
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
<!-- Employees by projects dialog -->
<div class="modal fade" id="epd_employees_projects_dialog" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Listado de empleados por proyecto</h4>
      </div>
      {{Form::open(['method' => 'GET', 'target' => '_new'])}}
      <div class="modal-body">
        <div class="form-group">
          <label for="">Proyecto</label>
          {{ Form::select('epd_project_id', $projects, old('project_id'), ['class' => 'form-control', 'required', 'placeholder' => 'Proyecto', 'style' => 'width:100%'])}}
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

<!-- Employees by group dialog -->
<div class="modal fade" id="employees_groups_dialog" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Listado de empleados por grupo</h4>
      </div>
      {{Form::open(['method' => 'GET', 'target' => '_new'])}}
      <div class="modal-body">
        <div class="form-group">
          <label for="">Proyecto</label>
          {{ Form::select('egd_project_id', $projects, old('egd_group_id'), ['class' => 'form-control', 'required', 'placeholder' => 'Proyectos', 'style' => 'width:100%', 'id' => 'egd_project_id'])}}
        </div>
        <div class="form-group">
          <label for="">Grupo</label>
          <select class="form-control" name="group_id" style="width: 100%">

          </select>
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

@section('script')
<!-- select2 library  -->
<script src="{{ asset('plugins/select2/select2.min.js') }}" charset="utf-8"></script>
<!-- axios library -->
<script src="{{ asset('plugins/axios/axios.min.js') }}" charset="utf-8"></script>

<script type="text/javascript">

  /**
   * Initialize select2 fields
   */
  $('select[name="project_id"]').select2({
    theme: 'bootstrap',
    dropdownParent: $('#employees_equipments')
  })

  $('select[name="epd_project_id"]').select2({
    theme: 'bootstrap',
    dropdownParent: $('#epd_employees_projects_dialog')
  })

  $('select[name="group_id"]').select2({
    theme: 'bootstrap',
    dropdownParent: $('#employees_groups_dialog')
  })

  $('select[name="egd_project_id"]').select2({
    theme: 'bootstrap',
    dropdownParent: $('#employees_groups_dialog')
  })

  $('select[name="ee_project_id"]').select2({
    theme: 'bootstrap',
    dropdownParent: $('#employees_equipments')
  })

  $('select[name="ee_group_id"]').select2({
    theme: 'bootstrap',
    dropdownParent: $('#employees_equipments')
  })

  var prjSelect = document.getElementById('egd_project_id')
  var grpSelect = document.querySelector('select[name="group_id"]')
  var eeProjectSelect = document.getElementById('ee_project_id')
  var eeGroupSelect = document.querySelector('select[name="ee_group_id"]')

  prjSelect.onchange = function() {

    for(i=0; i < grpSelect.options.length; i++) {
      grpSelect.text = ''
      grpSelect.options[i] = null
    }

    var projectId = prjSelect.options[prjSelect.selectedIndex].value
    axios.get(document.querySelector('meta[name="url"]').content
      +'/api/projects/'+projectId+'/groups').then((res) => {
        res.data.forEach(cb => {
          var option = document.createElement('option');
          option.text = cb.name
          option.value = cb.id
          grpSelect.appendChild(option)
        })
    }).catch(er => {
      alert(er)
    })
  }

  eeProjectSelect.onchange = function() {
    for(i=0; i < eeGroupSelect.options.length; i++) {
      eeGroupSelect.text = ''
      eeGroupSelect.options[i] = null
    }

    var projectId = eeProjectSelect.options[eeProjectSelect.selectedIndex].value
    axios.get(document.querySelector('meta[name="url"]').content
      +'/api/projects/'+projectId+'/groups').then((res) => {
        res.data.forEach(cb => {
          var option = document.createElement('option');
          option.text = cb.name
          option.value = cb.id
          eeGroupSelect.appendChild(option)
        })
    }).catch(er => {
      alert(er)
    })
  }
</script>
@endsection
