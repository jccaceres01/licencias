<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
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
        'name' => 'required|max:90',
        'address' => 'max:250',
        'country_id' => 'required',
        'description' => 'max:250',
        'email' => 'email|max:90|nullable'
      ];
  }

  /**
   * Get Messages for each rule
   */
  public function messages() {
    return [
      'name.required' => 'El campo: Nombre es necesario',
      'name.max' => 'El campo: Nombre, solo admite 90 caracteres',
      'address.max' => 'El campo: Dirección, solo admite 250 caracteres',
      'description' => 'El campo: Descripción, solo admite 250 caracteres',
      'email.email' => 'El campo: Correo Electronico, no es un correo valido',
      'email.max' => 'El campo: Correo Electronico, solo admite 90 caracteres'
    ];
  }
}
