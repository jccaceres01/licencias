<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesCoursesRequest extends FormRequest
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
          'course_id' => 'required',
          'date' => 'required'
        ];
    }

    public function messages() {
      return [
        'course_id.required' => 'El campo de identificacion es necesario',
        'date.required' => 'Es necesario indicar una fecha'
      ];
    }
}
