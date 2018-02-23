<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupsRequest extends FormRequest
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
          'name' => 'max:45|required',
          'employee_id' => 'required',
          'project_id' => 'required'
        ];
    }

    /**
     * Custom messages
     */
    public function messages() {
      return [
        'name.max' => 'El campo: Nombre, solo admite 45 caracteres',
        'name.required' => 'El campo: nombre, es necesario',
        'employee_id.required' => 'El campo: Supervisor, es necesario',
        'project_id.required' => 'El campo: Proyecto, es necesario'
      ];
    }
}
