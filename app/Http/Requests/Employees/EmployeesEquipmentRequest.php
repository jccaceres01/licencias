<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesEquipmentRequest extends FormRequest
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
          'equipment_type_id' => 'required',
          'date' => 'required'
        ];
    }

  /**
   * Get error messages
   */
  public function messages() {
    return [
      'equipment_type_id.required' => 'Es necesario indicar el equipo',
      'date.required' => 'Es necesario indicar la fecha en la que se tomo 
        el curso'
    ];
  }
}
