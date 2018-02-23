@extends ('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Usuarios
    <small>Administrar Usuarios</small>
  </h1>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-user"></i>
              Usuarios
            </h3>
            <div class="pull-right">
              <a href="{{ route('users.create')}}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Nuevo Usuario" data-placement="top"><i class="fa fa-plus-circle"></i></a>
            </div>
          </div>
          <div class="box-content">
            <div class="container-fluid">
              <form class="" action="{{ route('users.index')}}" method="GET" style="margin: 20px;">
                <div class="input-group">
                  <input type="text" name="criteria" class="form-control" placeholder="Buscar Usuario">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </form>
              <table class="table table-striped table-bordered">
                <thead>
                  <th><i class="fa fa-image"></i></th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Controles</th>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td> <img src="{{($user->imgpath != null) ? asset('/storage/'.$user->imgpath) : asset('/storage/img/page/no-image.png')}}" alt="" class="img img-responsive img-circle img-thumbnail" style="width: 35px; height: 35px"> </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <a href="{{ route('users.show', $user->id)}}" class="btn btn-default btn-xs"><i class="fa fa-eye" data-toggle="tooltip" title="Ver" data-plecement="top"></i></a>
                      <a href="{{ route('users.edit', $user->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" title="Editar" data-plecement="top"></i></a>
                      {{Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE', 'class' => 'form inline', 'onsubmit' => 'return confirm("¿Quiere borrar este registro?")'])}}
                      <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Borrar" data-placement="top">
                        <i class="fa fa-close"></i>
                      </button>
                      <div class="dropdown inline">
                        <button class="btn  btn-xs dropdown-toggle" type="button" id="" data-toggle="dropdown">

                          <span class="caret"></span>
                        </button>
                          @can('administrator')
                        <ul class="dropdown-menu" role="menu" aria-labelledby="">
                          <li><a href="{{ route('users.password.change', $user->id)}}"><i class="fa fa-key"></i>Restablecer Contraseña</a></li>
                          <li><a href="{{ route('users.permissions', $user->id)}}"><i class="fa fa-unlock-alt"></i>Permisos de Usuario</a></li>
                        </ul>
                        @endcan
                      </div>
                      {{ Form::close() }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="text-center">
                {{ $users->appends(\Request::except('page'))->render() }}
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
