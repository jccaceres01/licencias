@extends ('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Proyectos
    <small>Administrar Proyectos</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-university"></i>
              Proyectos
            </h3>
            <div class="pull-right">
              @can('create projects')<a href="{{ route('projects.create')}}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Nuevo Proyecto" data-placement="top"><i class="fa fa-plus-circle"></i></a>@endcan
            </div>
          </div>
          <div class="box-content">
            <div class="container-fluid">
              <form class="" action="{{ route('projects.index')}}" method="GET" style="margin: 20px;">
                <div class="input-group">
                  <input type="text" name="criteria" class="form-control" placeholder="Buscar Proyecto">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </form>
              <table class="table table-striped table-bordered">
                <thead>
                  <th>Nombre</th>
                  <th>Pais</th>
                  <th>Controles</th>
                </thead>
                <tbody>
                  @can('list projects')
                  @foreach($projects as $project)
                  <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->country->name }}</td>
                    <td>
                      @can('view projects')<a href="{{ route('projects.show', $project->id)}}" class="btn btn-default btn-xs"><i class="fa fa-eye" data-toggle="tooltip" title="Ver" data-plecement="top"></i></a>@endcan
                      @can('edit projects')<a href="{{ route('projects.edit', $project->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" title="Editar" data-plecement="top"></i></a>@endcan
                      @can('delete projects')
                      {{Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'DELETE', 'class' => 'form inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
                      <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Borrar" data-placement="top">
                        <i class="fa fa-close"></i>
                      </button>
                      {{ Form::close() }}
                      @endcan
                    </td>
                  </tr>
                  @endforeach
                  @endcan
                </tbody>
              </table>
              <div class="text-center">
                {{ $projects->appends(\Request::except('page'))->render() }}
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
