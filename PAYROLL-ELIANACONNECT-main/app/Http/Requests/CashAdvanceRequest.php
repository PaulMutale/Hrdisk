<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashAdvanceRequest extends FormRequest
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
            'title' => 'required|string',
            'date' => 'required',
			'employee_loan_amount' => 'required|numeric',
            'employee_total_repayment' => 'required|numeric',
            'employee_duration' => 'required|numeric',
			'employee_monthly' => 'required|numeric',
        ];
    }
}
