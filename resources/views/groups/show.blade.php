@extends ('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Grupos
    <small>Viendo grupo: {{ $group->name }}</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-calendar-times-o"></i>
              Grupo: {{ $group->name }}
            </h3>
            <div class="pull-right">
              @can('edit groups')<a href="{{ route('groups.edit', $group->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>@endcan
              @can('delete groups')
              {{Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'DELETE', 'class' => 'form inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
              <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Borrar" data-placement="top">
                <i class="fa fa-close"></i>
              </button>
              {{ Form::close() }}
              @endcan
            </div>
          </div>
          <div class="box-content">
            <div class="container-fluid">
              <div class="col-md-12">
                <dl class="dl-horizontal">
                  <dt><strong>Nombre</strong></dt>
                  <dd> {{ $group->name }}</dd>
                  <dt><strong>Supervisor</strong></dt>
                  <dd> {{ $group->supervisor->fullName }}</dd>
                  <dt><strong>Proyecto</strong></dt>
                  <dd> {{ $group->project->name }}</dd>
                </dl>
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
