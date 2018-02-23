<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EditEmployeesEquipmentRequest extends FormRequest
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
          'date' => 'required'
        ];
    }

  /**
   * Return error messages
   */
  public function messages() {
    return [
      'date.required' => 'Es necesario especificar una fecha'
    ];
  }
}
