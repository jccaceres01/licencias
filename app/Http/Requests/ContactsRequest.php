<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
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
          'firstnames' => 'max:45|required',
          'lastnames' => 'max:45|required',
          'email' => 'email|max:90|nullable',
          'phone' => 'max:45',
          'cell' => 'max:45',
          'address' => 'max:250',
          'employee_id' => 'required'
        ];
    }

  /**
   * Get error messages of each validation
   */
  public function messages() {
    return [
      'firstnames.max' => 'El campo: Nombres, solo admite 45 caracteres',
      'firstnames.required' => 'El campo: Nombres, es necesario',
      'lastnames.max' => 'El campo: Apellidos, solo admite 45 caracteres',
      'lastnames.required' => 'El campo: Apellidos, es necesario',
      'email.email' => 'El campo: Correo Electronico, no es un correo valido',
      'email.max' => 'El campo: Correo Electornico, solo admite 90 caracteres',
      'phone.max' => 'El campo: Telefono, solo admite 45 caracteres',
      'cell.max' => 'El campo: Celular, solo admite 45 caracteres',
      'address.max' => 'El campo: Dirección, solo admite 250 caracteres',
      'employee_id' => 'No se recivio el parametro identificador de empleado'
    ];
  }
}
