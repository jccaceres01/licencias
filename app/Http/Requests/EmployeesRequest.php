<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeesRequest extends FormRequest
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
          'code' => ['required', 'max:15', Rule::unique('employees')->ignore($this->id)],
          'firstnames' => 'required|max:90',
          'lastnames' => 'required|max:90',
          'nickname' => 'max:45',
          'identity_document' => ['required', 'max:45', Rule::unique('employees')->ignore($this->id)],
          'address' => 'max:255',
          'email' => 'email|max:90|nullable',
          'phonenumber' => 'max:45',
          'cellphone' => 'max:45',
          'position' => 'max:90',
          'drive_license' => 'max:45',
          'project_id' => 'required',
          'employee_type' => 'required',
          'status' => ['nullable', Rule::in('activo', 'cacelado', 'parado')]
        ];
    }

    /**
     * Custom messages
     */
    public function messages() {
      return [
        'code.required' => 'El campo: Codigo, es necesario',
        'code.max' => 'El campo: Codigo, solo admite 15 caracteres',
        'code.unique' => 'El campo: Codigo, debe de ser unico, ya existe un codigo similar',
        'firstnames.required' => 'El campo: Nombres, es necesario',
        'firstnames.max' => 'El campo: Nombres, solo admite 90 caracteres',
        'lastnames.required' => 'El campo: Apellidos, es necesario',
        'lastnames.max' => 'El campo: Apellidos, solo admite 90 caracteres',
        'nickname.max' => 'El campo: Apodo, solo admite 45 caracteres',
        'identity_document.max' => 'El campo: Cedula, solo admite 45 caracteres',
        'identity_document.required' => 'El campo: Cedula, es necesario',
        'identity_document.unique' => 'El campo: Cedula, debe de ser unico, ya existe un registro similar',
        'address.max' => 'El campo: Direccion, solo admite 255 caracteres',
        'email.email' => 'El campo: Correo Electronico, debe ser una direccion de correo valida',
        'email.max' => 'El campo: Email, solo admite 45 caracteres',
        'phonenumber.max' => 'El campo: Telefono, solo admite 45 caracteres',
        'cellphone.max' => 'El campo: Celular, solo admite 45 caracteres',
        'position.max' => 'El campo: Posicion, solo admite 90 caracteres',
        'drive_license.max' => 'El campo: Licencia de Conducir, solo admite 45 caracteres',
        'drive_license_category.in' => 'El campo: Categoria de Licencia, solo admite los siguientes valores: 01 Conductor, 02 Conductor, 03 Primera pesados, 04 Segunda pesados, 05 Especial',
        'project_id.required' => 'El campo: Proyecto, es necesario',
        'status.required' => 'El campo: Status, es necesario',
        'status.in' => 'El campo: Status, debe de ser una de las siguientes opciones: activo, cancelado, parado',
        'employee_type.required' => 'El campo: Tipo de Empleado, Es necesario'
      ];
    }
}
