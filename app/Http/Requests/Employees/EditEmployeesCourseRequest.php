<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EditEmployeesCourseRequest extends FormRequest
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

  public function rules()
  {
    return [
      'date' => 'required'
    ];
  }

  /**
   * Get error messages
   */
  public function messages() {
    return [
      'date.required' => 'La fecha es requerida'
    ];
  }
}
