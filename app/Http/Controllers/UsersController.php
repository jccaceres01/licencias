<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UsersRequest;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
  /**
   * Contructor
   */
  public function __construct() {
    $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if (\Auth::user()->can('administrator')) {
        return view('users.index')
          ->with('users', User::search($request->criteria)
          ->orderBy('name')->paginate(10));
      } else {
        \Notify::warning('Necesita permisos de administrador para acceder
          a esta función', 'Información');
        return redirect()->back();
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->can('administrator')) {
        return view('users.create');
      } else {
        \Notify::warning('Necesita permisos de administrador para acceder
          a esta función', 'Información');
        return redirect()->back();
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
      if (\Auth::user()->can('administrator')) {
        try {
          $user = User::create($request->all());
        } catch (\Exception $e) {
          switch ($e->getCode()) {
            default:
              \Notify::error('Error: '.$e->getMessage(),
                '<strong>Error</strong>');
              return redirect()->back();
          }
        }

        if ($request->hasFile('imgpath')) {
          $path = $request->imgpath->store('img/profile', 'public');
          $user->imgpath = $path;
          $user->save();
        }

        \Notify::success('Usuario Agregado', '<strong>Información</strong>');
        return redirect()->route('users.index');
      } else {
        \Notify::warning('Necesita permisos de administrador para acceder
          a esta función', 'Información');
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if (\Auth::user()->can('administrator')) {
        return view('users.show')->with('user', User::find($id));
      } else {
        \Notify::warning('Necesita permisos de administrador para acceder
          a esta función', 'Información');
        return redirect()->back();
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (\Auth::user()->can('administrator')) {
        return view('users.edit')->with('user', User::find($id));
      } else {
        \Notify::warning('Necesita permisos de administrador para acceder
          a esta función', 'Información');
        return redirect()->back();
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (\Auth::user()->can('administrator')) {
        $rules = [
          'name' => 'required|max:255',
          'email' => ['email', 'max:255', Rule::unique('users')
            ->ignore($request->user_id, 'id')]
        ];

        $messages = [
          'name.required' => 'El campo: Nombre, es necesario',
          'name.max' => 'El campo: nombre, solo admite 255 caracteres',
          'email.email' => 'El campo: Correo Electronico, no es un correo valido',
          'email.max'
            => 'El campo: Correo Electronico, solo admite 255 caracteres',
          'email.unique' => 'Ya existe un correo similar en la base de datos'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
          return redirect()->back()->withInput()
            ->withErrors($validator->messages());
        } else {
          $user = User::find($id);

          try {
            $user->update($request->except(['password']));
            $user->save();

            if ($request->hasFile('imgpath')) {
              if ($user->imgpath == null) {
                $path = $request->imgpath->store('img/profile', 'public');
                $user->imgpath = $path;
                $user->save();
              } else {
                $oldImg = $user->imgpath;
                $path = $request->imgpath->store('img/profile', 'public');
                $user->imgpath = $path;
                $user->save();
                \Storage::drive('public')->delete($oldImg);
              }
            }

            \Notify::success('Usuario Modificado',
              '<strong>Información</strong>');
            return redirect()->route('users.show', $user->id);

          } catch (\Exception $e) {
            switch ($e->getCode()) {
              case '23000':
                \Notify::error('Otros registros dependen de este',
                  '<strong>Error</strong>');
                return redirect()->back();
              default:
                \Notify::error('Error: '.$e->getMessage(),
                  '<strong>Error</strong>');
                return redirect()->back();
            }
          }
        }
      } else {
        \Notify::warning('Necesita permisos de administrador para acceder
          a esta función', 'Información');
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (\Auth::user()->can('administrator')) {
        $user = User::find($id);

        if ($user->email == \Auth::user()->email) {
          \Notify::error('No puede borrar su propio usuario,
            contacte otro administrador para realizar dicha acción',
            '<strong>Error</strong>');
          return redirect()->back();
        } else {
          try {
            User::destroy($id);

            \Notify::success('Usuario Borrado', '<strong>Información</strong>');
            return redirect()->route('users.index');
          } catch (\Exception $e) {
            switch ($e->getCode()) {
              case '23000':
              \Notify::error('Otros registros dependen de este',
                '<strong>Error</strong>');
              return redirect()->back();
              default:
                \Notify::error('Error: '.$e->getMessage(),
                  '<strong>Error</strong>');
                return redirect()->back();
            }
          }
        }
      } else {
        \Notify::warning('Necesita permisos de administrador para acceder
          a esta función', 'Información');
        return redirect()->back();
      }
    }

  /**
   * Get password change view
   */
  public function getChangePassword($id) {
    if (\Auth::user()->can('administrator')) {
      return view('users.passwordchange')->with('user', User::find($id));
    } else {
      \Notify::warning('Necesita permisos de administrador para acceder
        a esta función', 'Información');
      return redirect()->back();
    }
  }

  /**
   * Changes password from panel to a user
   */
  public function postChangePassword(Request $request, $id) {
    if (\Auth::user()->can('administrator')) {
      $user = User::find($id);

      $rules = [
        'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
        'repassword' => 'same:password|required'
      ];

      $messages = [
        'password.required' => 'El campo: Contraseña es necesario',
        'password.regex' => 'La Contraseña no cumple los requisitos minimos',
        'repassword.same' => 'Las contraseñas no coinciden',
        'repassword.required' => 'El campo: Repetir Contraseña, es necesario'
      ];

      $validator = \Validator::make($request->all(), $rules, $messages);

      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->messages());
      } else {
        $user->password = \Hash::make($request->password);
        $user->save();
        \Notify::success('Contraseña modificada correctamente',
          '<strong>Información</strong>');
        return redirect()->route('users.index');
      }
    } else {
      \Notify::warning('Necesita permisos de administrador para acceder
        a esta función', 'Información');
      return redirect()->back();
    }
  }

  /**
   * Get permissions for a user
   */
  public function getPermissions($id) {
    if (\Auth::user()->can('administrator')) {
      $user = User::find($id);
      return view('users.permissions')->with('user', $user);
    } else {
      \Notify::warning('Necesita permisos de administrador para acceder
        a esta función', 'Información');
      return redirect()->back();
    }
  }

  /**
   * Save permissions to a user
   */
  public function postPermissions(Request $request, $id) {
    if (\Auth::user()->can('administrator')) {
      $user = User::find($id);

      try {
        $user->syncPermissions($request->permissions);

        \Notify::success('Control de acceso actualizado',
          '<strong>Información</strong>');
        return redirect()->route('users.show', $user->id);
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e->getMessage(), 'Error');
            return redirect()->back();
        }
      }
    } else {
      \Notify::warning('Necesita permisos de administrador para acceder
        a esta función', 'Información');
      return redirect()->back();
    }
  }
}
