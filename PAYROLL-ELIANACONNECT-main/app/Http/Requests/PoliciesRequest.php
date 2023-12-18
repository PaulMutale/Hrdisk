<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoliciesRequest extends FormRequest
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
            'task' => 'required|string',
            'agenda' => 'required|mimes:doc,docx,pdf|max:10240',// Less than or equal to 10mb
			
        ];
    }
}
