<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class leave_daysRequest extends FormRequest
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
            'leave_name' => "required",
            'exhausted_leaves' => "required",
            'remaining_leaves' => "required"
            
        ];
    }
}
