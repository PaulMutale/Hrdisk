<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeductionRequest extends FormRequest
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
        if ($this->method() == 'PUT') 
        {
            $name_rules = "required"; 
        }
        else 
        {
            $name_rules = "required";
        }
        return [
            'name' => "required|string",//$name_rules,
            'deduction_code' => "required|string",
            'description' => "required|string",
        ];
    }
}
