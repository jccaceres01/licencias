@extends ('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Grupos
    <small>Administrar grupos</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-calendar-times-o"></i>
              Grupos
            </h3>
            <div class="pull-right">
              @can('create groups')<a href="{{ route('groups.create')}}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Nuevo Turno" data-placement="top"><i class="fa fa-plus-circle"></i></a>@endcan
            </div>
          </div>
          <div class="box-content">
            <div class="container-fluid">
              @can('list groups')
              <form class="" action="{{ route('groups.index')}}" method="GET" style="margin: 20px;">
                <div class="input-group">
                  <input type="text" name="criteria" class="form-control" placeholder="Buscar Turno">
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
                  <th>Supervisor</th>
                  <th>Proyecto</th>
                  <th>Controles</th>
                </thead>
                <tbody>
                  @foreach($groups as $group)
                  <tr>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->supervisor->fullName }}</td>
                    <td>{{ $group->project->name }}</td>
                    <td>
                      @can('view groups')<a href="{{ route('groups.show', $group->id)}}" class="btn btn-default btn-xs"><i class="fa fa-eye" data-toggle="tooltip" title="Ver" data-plecement="top"></i></a>@endcan
                      @can('edit groups')<a href="{{ route('groups.edit', $group->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" title="Editar" data-plecement="top"></i></a>@endcan
                      @can('delete groups')
                      {{Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'DELETE', 'class' => 'form inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
                      <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Borrar" data-placement="top">
                        <i class="fa fa-close"></i>
                      </button>
                      {{ Form::close() }}
                      @endcan
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="text-center">
                {{ $groups->appends(\Request::except('page'))->render() }}
              </div>
              @else
              <div class="row">
                <div class="col-md-12">
                  <h1 class="text-center">No tiene privilegios para listar grupos </h1>
                </div>
              </div>
              @endcan
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
