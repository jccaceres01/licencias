<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|max:255',
          'email' => 'email|max:255|unique:users',
          'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
          'repassword' => 'same:password|required'
        ];
    }

  /**
   * got custom messages
   */
  public function messages() {
    return [
      'name.required' => 'El campo: Nombre, es necesario',
      'name.max' => 'El campo: nombre, solo admite 255 caracteres',
      'email.email' => 'El campo: Correo Electronico, no es un correo valido',
      'email.max' => 'El campo: Correo Electronico, solo admite 255 caracteres',
      'email.unique' => 'Ya existe un correo similar en la base de datos',
      'password.required' => 'El campo: Contraseña es necesario',
      'password.regex' => 'La Contraseña no cumple los requisitos minimos',
      'repassword.same' => 'Las contraseñas no coinciden',
      'repassword.required' => 'El campo: Repetir Contraseña, es necesario'
    ];
  }
}
